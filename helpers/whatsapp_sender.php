<?php
// File: helpers/whatsapp_sender.php

/**
 * Mengirim notifikasi teks dan/atau gambar via Fonnte API.
 * @param string $target Nomor tujuan (misal: 8123456789)
 * @param string $message Isi pesan
 * @param string|null $imageUrl URL gambar (opsional, untuk bukti pembayaran)
 * @param string $filename Nama file (opsional, hanya untuk tampilan di WA)
 * @return string Respon dari Fonnte API
 */
function sendWhatsAppNotification($target, $message, $imageUrl = null, $filename = null) {
    // Ganti TOKEN di sini dengan token API Fonnte Anda yang sebenarnya
    $token = "PSb4ar7j6d482Bvphgc1"; 
    $apiUrl = "https://api.fonnte.com/send";

    $postFields = array(
        'target' => $target,
        'message' => $message,
        'countryCode' => '62',
    );

    // Tambahkan file jika URL gambar disediakan
    if ($imageUrl) {
        $postFields['url'] = $imageUrl;
        if ($filename) {
            $postFields['filename'] = $filename;
        }
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $apiUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postFields,
        CURLOPT_HTTPHEADER => array(
            "Authorization: " . $token
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    
    // Log response ke error log PHP untuk debugging
    error_log("Fonnte Response: " . $response);

    return $response;
}
?>