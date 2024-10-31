<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PresensiResource\Pages;
use App\Filament\Resources\PresensiResource\RelationManagers;
use App\Models\Presensi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Carbon\Carbon;

class PresensiResource extends Resource
{
    protected static ?string $model = Presensi::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Presensi';
    protected static ?string $navigationGroup = 'Data';

    public static function form(Form $form): Form
    {
        $today = now()->format('Y-m-d');
        $currentUserId = auth()->id();
        $presensi = Presensi::whereDate('tanggal', $today)
            ->where('user_id', $currentUserId)
            ->first();

        $schema = [
            Forms\Components\Hidden::make('user_id')->default($currentUserId), // Menyimpan user_id
            Forms\Components\TextInput::make('latitude')->required(),
            Forms\Components\TextInput::make('longitude')->required(),
            Forms\Components\DatePicker::make('tanggal')->default(now()),
            Forms\Components\FileUpload::make('image_masuk')->label('Gambar Masuk')->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif']),
            Forms\Components\FileUpload::make('image_pulang')->label('Gambar Pulang')->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif']),
        ];

        if ($presensi && is_null($presensi->pulang)) {
            // Jika sudah absen masuk, tampilkan jam pulang dan gambar pulang
            $schema[] = Forms\Components\TimePicker::make('pulang')->label('Jam Pulang')->default(Carbon::now()->format('H:i'));
        } else {
            // Jika belum absen masuk, tampilkan jam masuk
            $schema[] = Forms\Components\TimePicker::make('masuk')->label('Jam Masuk')->default(Carbon::now()->format('H:i'));
        }

        return $form->schema($schema);
    }

    private static function hitungJamKerja($masuk, $pulang)
{
    if ($masuk && $pulang) {
        $masukTime = \Carbon\Carbon::createFromFormat('H:i:s', $masuk);
        $pulangTime = \Carbon\Carbon::createFromFormat('H:i:s', $pulang);
        return $pulangTime->diffInHours($masukTime); // Menghitung selisih jam
    }
    return 0; // Jika belum ada jam masuk atau pulang
}

private static function hitungGaji($masuk, $pulang)
{
    $tarifPerJam = 25000; // Tarif per jam
    $jamKerja = self::hitungJamKerja($masuk, $pulang); // Hitung jam kerja

    // Menghitung gaji
    $gaji = $jamKerja * $tarifPerJam;

    return $gaji; // Mengembalikan total gaji
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')->label('User ID'),
                Tables\Columns\TextColumn::make('latitude')->label('Latitude'),
                Tables\Columns\TextColumn::make('longitude')->label('Longitude'),
                Tables\Columns\TextColumn::make('tanggal')->label('Tanggal'),
                Tables\Columns\TextColumn::make('masuk')->label('Jam Masuk'),
                Tables\Columns\TextColumn::make('pulang')->label('Jam Pulang'),
                Tables\Columns\ImageColumn::make('image_masuk')->label('Gambar Masuk'), // Mengganti menjadi image_masuk
                Tables\Columns\ImageColumn::make('image_pulang')->label('Gambar Pulang'), // Mengganti menjadi image_pulang
                Tables\Columns\TextColumn::make('jam_kerja')->label('Jam Kerja')
                    ->formatStateUsing(fn ($record) => self::hitungJamKerja($record->masuk, $record->pulang)), // Menghitung jam kerja

                Tables\Columns\TextColumn::make('gaji')->label('Gaji')
                    ->formatStateUsing(fn ($record) => self::hitungGaji($record->masuk, $record->pulang)), // Menghitung gaji
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPresensis::route('/'),
            'create' => Pages\CreatePresensi::route('/create'),
            'edit' => Pages\EditPresensi::route('/{record}/edit'),
        ];
    }
}
