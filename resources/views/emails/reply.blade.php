<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Balasan Pesan</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
        <div style="text-align: center; padding-bottom: 20px; border-bottom: 2px solid #0F6E56;">
            <h2 style="color: #0F6E56;">OSIS SMA 5 Morotai</h2>
            <p style="color: #666;">Balasan Pesan Anda</p>
        </div>
        
        <div style="padding: 20px 0;">
            <p>Yth. <strong>{{ $nama }}</strong>,</p>
            
            <p>Terima kasih telah menghubungi kami. Berikut adalah balasan dari pesan Anda:</p>
            
            <div style="background: #f5f5f5; padding: 15px; border-radius: 8px; margin: 20px 0;">
                <p style="margin: 0;"><strong>Pesan Anda:</strong></p>
                <p style="margin: 10px 0 0 0; color: #555;">"{{ $pesan_asal }}"</p>
            </div>
            
            <div style="background: #e8f5e9; padding: 15px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #0F6E56;">
                <p style="margin: 0;"><strong>Balasan dari Kami:</strong></p>
                <p style="margin: 10px 0 0 0; color: #333;">"{{ $balasan }}"</p>
            </div>
            
            <p>Jika ada pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami kembali.</p>
            
            <p>Salam hangat,<br>
            <strong>OSIS SMA Negeri 5 Kab. Pulau Morotai</strong></p>
        </div>
        
        <div style="text-align: center; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #999;">
            <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} OSIS SMA 5 Morotai. All rights reserved.</p>
        </div>
    </div>
</body>
</html>