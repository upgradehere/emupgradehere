{{-- resources/views/mcu/pemeriksaan/print/cetak_barcode_multi.blade.php --}}
@php
    // ===== Label 5 cm x 2.5 cm (final fix: 24.5 mm tinggi konten) =====
    $LABEL_W = 50;   // mm
    $LABEL_H = 25;   // mm

    // Padding & quiet zone
    $QUIET_LR_MM = 3.0;   // kiri/kanan
    $PAD_TB_MM   = 0.8;   // atas/bawah

    // Ambil 1 data
    $item = $page ?? ((isset($pages) && count($pages)) ? $pages[0] : []);

    // --- Payload hanya angka ---
    $raw = $item['mcu_code'] ?? ($item['mcu'] ?? '');
    $numeric = preg_replace('/\D+/', '', (string)$raw);
    if ($numeric === '') { $numeric = '000000000000'; }
    if (strlen($numeric) % 2 === 1) { $numeric = '0' . $numeric; } // harus genap untuk Code128C
    $displayText = $numeric;

    // --- Data tambahan (teks di bawah) ---
    $nik      = $item['nik']            ?? '';
    $name     = strtoupper($item['employee_name'] ?? '');
    $company  = strtoupper($item['company_name']  ?? '');
    $pkg      = strtoupper($item['package_name']  ?? '');
    $examDate = $item['exam_date']      ?? '';
    $sex      = $item['sex']            ?? '';
    $dob      = $item['dob']            ?? '';

    // --- Generate barcode Code 128C ---
    $widthFactor = 3.4;   // bar lebih tebal = scanner murah lebih mudah
    $heightPx    = 150;   // sedikit lebih pendek agar muat di 25mm
    $dns = new \Milon\Barcode\DNS1D();
    $barcodePng = $dns->getBarcodePNG($numeric, 'C128C', $widthFactor, $heightPx);
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Label Barcode 50×25 mm (Final)</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  /* ===== 1 label = 1 halaman, dikunci ke 50×25 mm ===== */
  @page { size: {{ $LABEL_W }}mm {{ $LABEL_H }}mm; margin: 0; }
  html, body {
    width: {{ $LABEL_W }}mm; height: {{ $LABEL_H }}mm;
    margin: 0; padding: 0; background: #fff;
    -webkit-print-color-adjust: exact; print-color-adjust: exact;
  }
  * { box-sizing: border-box; margin:0; padding:0; }

  /* Label isi sedikit lebih kecil agar tidak overflow */
 .label {
    width: 100%;
    height: 24mm;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;   /* mulai dari atas */
    padding: 1mm 0mm 0 2.5mm;        /* tambah padding atas 1 mm */
    background: #fff;
    overflow: hidden;
    page-break-inside: avoid;
}



  /* Barcode */
  .barcode-box { width: 90%; line-height: 0; background:#fff; }
 .barcode-img {
    display: block;
    width: 100%;
    height: 11.0mm;
    image-rendering: pixelated;
    margin-bottom: 0.5mm; /* jarak kecil ke teks */
}


  /* Text */
  .text { margin-top: 0.4mm; text-align: center; font-family: Arial, Helvetica, sans-serif; color:#000; line-height:1.06; white-space:nowrap; margin-right:5mm;}
  .mcu-line { font-weight:700; font-size:3mm; margin-bottom:0.1mm; }
  .line { font-size:2.5mm; }
  .line2 { font-size:1.7mm; }
  .line3 { font-size:2.2mm; }

</style>
</head>
<body>

<div class="label">
  <div class="barcode-box">
    <img class="barcode-img" alt="barcode" src="data:image/png;base64,{{ $barcodePng }}">
  </div>
  <div class="text">
    <div class="mcu-line">
    {{ $displayText }}@if($displayText && $nik) | @endif{{ $nik }}
    </div>
    @if($name)<div class="line">{{ $name }}</div>@endif
    @if($company)<div class="line2">{{ $company }}</div>@endif
    @if($pkg || $examDate || $sex || $dob)
      <div class="line3">
        {{ $pkg }}
        @if($examDate) | {{ $examDate }} @endif
        @if($sex) | {{ $sex }} @endif
        @if($dob) | {{ $dob }} @endif
      </div>
    @endif
  </div>
</div>

</body>
</html>
