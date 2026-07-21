<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoreStack Academy - Official Payment Receipt</title>
</head>
<body style="background-color: #f9f9f8; color: #44403c; font-family: 'DejaVu Sans', sans-serif; -webkit-font-smoothing: antialiased; padding: 24px; margin: 0;">

    <div style="max-w: 600px; margin: 0 auto; background-color: #ffffff; padding: 32px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e7e5e4;">
        
        <!-- Header -->
        <div style="text-align: center; border-bottom: 1px solid #e7e5e4; padding-bottom: 24px; margin-bottom: 24px;">
            <!-- School Logo Component from Asset Directory (Size increased to 80px) -->
            <img src="{{public_path('image/core-stack.png')}}" alt="CoreStack Academy Logo" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 12px; border: 2px solid #e7e5e4;" />
            
            <h1 style="margin: 0; font-size: 20px; font-weight: 800; color: #1e2d54; text-transform: uppercase; letter-spacing: 0.05em;">CoreStack Academy</h1>
            <p style="margin: 4px 0 0 0; font-size: 11px; font-weight: 700; color: #d97706; tracking-wider: 0.05em; text-transform: uppercase;">Official Payment Receipt</p>
        </div>

        <!-- Meta Details Grid & QR Code Container -->
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; gap: 20px;">
            
            <!-- Left Side: Data Fields -->
            <div style="flex-grow: 1; display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
                <div>
                    <p style="margin: 0; font-size: 10px; color: #a8a29e; font-weight: 700; text-transform: uppercase;">Payment ID</p>
                    <p style="margin: 2px 0 0 0; font-size: 13px; font-weight: 600; color: #44403c; word-break: break-all;">{{ $payment->id }}</p>
                </div>
                <div>
                    <p style="margin: 0; font-size: 10px; color: #a8a29e; font-weight: 700; text-transform: uppercase;">Transaction ID</p>
                    <p style="margin: 2px 0 0 0; font-size: 13px; font-weight: 600; color: #44403c; word-break: break-all;">{{ $payment->paypal_transection_id ?? 'N/A' }}</p>
                </div>
                <div>
                    <p style="margin: 0; font-size: 10px; color: #a8a29e; font-weight: 700; text-transform: uppercase;">Academic Session</p>
                    <p style="margin: 2px 0 0 0; font-size: 13px; font-weight: 600; color: #44403c;">{{ $payment->session }}</p>
                </div>
                <div>
                    <p style="margin: 0; font-size: 10px; color: #a8a29e; font-weight: 700; text-transform: uppercase;">Status</p>
                    <span style="display: inline-block; margin-top: 4px; padding: 2px 8px; font-size: 10px; font-weight: 800; color: #166534; background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 4px; text-transform: uppercase;">PAID</span>
                </div>
            </div>

            <!-- Right Side: Clean Verification QR Box -->
            <div style="flex-shrink: 0; text-align: center; border: 1px solid #e7e5e4; background-color: #fafaf9; padding: 10px; border-radius: 8px;">
                <!-- Fixed: Wraps the QR code inside an image src utilizing standard base64 SVG so the PDF engine reads it cleanly without Imagick extensions -->
                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::size(90)->color(26, 43, 76)->generate(url()->current())) !!}" 
                     alt="Verification QR Code" 
                     style="width: 90px; height: 90px; display: block;" />
                <span style="display: block; font-size: 8px; font-weight: 700; color: #a8a29e; text-transform: uppercase; margin-top: 6px; letter-spacing: 0.05em;">Verify Receipt</span>
            </div>

        </div>

        <!-- Total Box -->
        <div style="background-color: #1e2d54; color: #ffffff; border-radius: 8px; padding: 16px 20px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <span style="font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; color: #cbd5e1;">Total Amount Remitted</span>
            <span style="font-size: 20px; font-weight: 900; color: #ffffff; display: flex; align-items: center;">
                {{-- <img src="{{public_path('image/naria.png')}}" alt="₦" style="height: 18px; width: auto; vertical-align: middle; margin-right: 4px;" /> --}}
             NGN {{ number_format($payment->amount_paid, 2) }}
            </span>
        </div>

        <!-- Footer -->
        <p style="text-align: center; font-size: 10px; color: #a8a29e; margin: 32px 0 0 0; border-top: 1px solid #e7e5e4; padding-top: 16px; line-height: 1.5;">
            &copy; {{ date('Y') }} CoreStack Institute - Academic Portal.<br>
            This is a secure system-generated document. Verification code embedded.
        </p>
    </div>

</body>
</html>