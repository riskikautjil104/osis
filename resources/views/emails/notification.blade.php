<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notifikasi Pesan Baru</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #0F6E56;">Pesan Baru dari Website</h2>
        
        <div style="background: #f0f0f0; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <p><strong>Nama:</strong> {{ $pesan->nama }}</p>
            <p><strong>Email:</strong> {{ $pesan->email }}</p>
            <p><strong>No HP:</strong> {{ $pesan->no_hp ?? '-' }}</p>
            <p><strong>Subjek:</strong> {{ $pesan->subjek }}</p>
            <p><strong>Pesan:</strong></p>
            <p style="background: white; padding: 10px; border-radius: 5px;">{{ $pesan->pesan }}</p>
        </div>
        
        <a href="{{ url('/dashboard/pesan/' . $pesan->id) }}" style="background: #0F6E56; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Lihat & Balas Pesan
        </a>
    </div>
</body>
</html>