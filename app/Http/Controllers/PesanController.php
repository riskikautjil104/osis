<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PesanController extends Controller
{
    // Dashboard: Menampilkan semua pesan
    public function index()
    {
        $pesan = Pesan::orderBy('created_at', 'desc')->get();
        $unreadCount = Pesan::where('status', 'belum_dibaca')->count();
        return view('dashboard.pesan.index', compact('pesan', 'unreadCount'));
    }
    
    // Dashboard: Detail pesan
    public function show($id)
    {
        $pesan = Pesan::findOrFail($id);
        
        if ($pesan->status == 'belum_dibaca') {
            $pesan->update([
                'status' => 'sudah_dibaca',
                'dibaca_pada' => now()
            ]);
        }
        
        return view('dashboard.pesan.show', compact('pesan'));
    }
    
    // Dashboard: Balas pesan via email
    public function reply(Request $request, $id)
    {
        $pesan = Pesan::findOrFail($id);
        
        $request->validate([
            'balasan' => 'required|string'
        ]);
        
        // Kirim email balasan
        $this->sendReplyEmail($pesan, $request->balasan);
        
        // Update status
        $pesan->update([
            'balasan' => $request->balasan,
            'status' => 'dibalas'
        ]);
        
        return redirect()->route('dashboard.pesan.show', $pesan->id)
            ->with('success', 'Balasan berhasil dikirim ke ' . $pesan->email);
    }
    
    // Dashboard: Hapus pesan
    public function destroy($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();
        
        return redirect()->route('dashboard.pesan')
            ->with('success', 'Pesan berhasil dihapus');
    }
    
    // PUBLIC: Kirim pesan dari form hubungi kami
    public function send(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string'
        ]);
        
        // Simpan ke database
        $pesan = Pesan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'subjek' => $request->subjek,
            'pesan' => $request->pesan,
            'status' => 'belum_dibaca'
        ]);
        
        // Kirim notifikasi email ke admin (opsional)
        $this->sendNotificationToAdmin($pesan);
        
        return response()->json([
            'success' => true,
            'message' => 'Pesan Anda berhasil dikirim. Terima kasih!'
        ]);
    }
    
    // Kirim email balasan ke pengirim
    private function sendReplyEmail($pesan, $balasan)
    {
        $data = [
            'nama' => $pesan->nama,
            'subjek_asal' => $pesan->subjek,
            'pesan_asal' => $pesan->pesan,
            'balasan' => $balasan
        ];
        
        Mail::send('emails.reply', $data, function ($mail) use ($pesan) {
            $mail->to($pesan->email, $pesan->nama)
                 ->subject('Balasan Pesan Anda - OSIS SMA 5 Morotai')
                 ->from('noreply@osis-sma5.sch.id', 'OSIS SMA 5 Morotai');
        });
    }
    
    // Kirim notifikasi ke admin (email)
    private function sendNotificationToAdmin($pesan)
    {
        Mail::send('emails.notification', ['pesan' => $pesan], function ($mail) {
            $mail->to('admin@osis-sma5.sch.id', 'Admin OSIS')
                 ->subject('Pesan Baru dari Website OSIS')
                 ->from('noreply@osis-sma5.sch.id', 'Website OSIS');
        });
    }
}