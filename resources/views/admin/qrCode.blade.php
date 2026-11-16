@extends('admin.layouts.app')

@section('content')
    <div class="container">

        <h3 class="mb-4 text-center">به پنل مدیریت خوش آمدید</h3>
        <p>از منوی کنار می‌توانید بخش‌های مختلف سایت را مدیریت کنید.</p>

    
      {{-- دانلود QR منو --}}
        <div class="text-center mt-4">
            <h4 class="text-white">دانلود QR منوی شما</h4>

            <div id="qr-code">
                {!! $qr !!}
            </div>

            <button id="downloadQr" class="btn btn-primary mt-2"
                    style="padding:10px 18px; font-size:16px;">
                📥 دانلود QR
            </button>
        </div>  
        <script>
            document.getElementById('downloadQr').addEventListener('click', function() {
                const svg = document.querySelector('#qr-code svg');
    
                if (!svg) return;
    
                const svgData = new XMLSerializer().serializeToString(svg);
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
    
                const img = new Image();
                const svgBlob = new Blob([svgData], {
                    type: "image/svg+xml;charset=utf-8"
                });
                const url = URL.createObjectURL(svgBlob);
    
                img.onload = function() {
                    canvas.width = img.width;
                    canvas.height = img.height;
                    ctx.drawImage(img, 0, 0);
                    URL.revokeObjectURL(url);
    
                    const pngUrl = canvas.toDataURL("image/png");
    
                    const a = document.createElement('a');
                    a.href = pngUrl;
                    a.download = 'menu-qr.png';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                };
    
                img.src = url;
            });
        </script>
    
    @endsection