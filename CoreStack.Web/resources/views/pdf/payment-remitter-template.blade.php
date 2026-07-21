<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoreStack Academy - Official Payment Receipt</title>
</head>
<!-- Fixed the Font Family here to DejaVu Sans so your currency symbols render perfectly -->
<body style="background-color: #f9f9f8; color: #44403c; font-family: 'DejaVu Sans', sans-serif; -webkit-font-smoothing: antialiased; padding: 24px; margin: 0;">

    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 32px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e7e5e4;">
        
        <!-- Header -->
        <div style="text-align: center; border-bottom: 1px solid #e7e5e4; padding-bottom: 20px; margin-bottom: 20px;">
            <!-- School Logo Component from Asset Directory -->
            <img src="{{ public_path('image/core-stack.png') }}" alt="CoreStack Academy Logo" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 12px; border: 2px solid #e7e5e4;" />
            
            <h1 style="margin: 0; font-size: 20px; font-weight: 800; color: #1e2d54; text-transform: uppercase; letter-spacing: 0.05em;">CoreStack Academy</h1>
            <p style="margin: 4px 0 0 0; font-size: 11px; font-weight: 700; color: #d97706; text-transform: uppercase;">Official Payment Receipt</p>
        </div>

        <!-- Student Information Section -->
        <div style="background-color: #fafaf9; border: 1px solid #e7e5e4; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
            <p style="margin: 0 0 12px 0; font-size: 11px; font-weight: 800; color: #1e2d54; text-transform: uppercase; border-bottom: 1px solid #e7e5e4; padding-bottom: 6px;">
                Student Information
            </p>
            <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
                <tr>
                    <td style="padding: 4px 0; color: #a8a29e; font-weight: 700; text-transform: uppercase; width: 35%; font-size: 10px;">Full Name:</td>
                    <td style="padding: 4px 0; font-weight: 600; color: #44403c;">{{ $studentProfile?->User?->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td style="padding: 4px 0; color: #a8a29e; font-weight: 700; text-transform: uppercase; font-size: 10px;">Matric / Reg No:</td>
                    <td style="padding: 4px 0; font-weight: 600; color: #44403c;">{{ $studentProfile->matric_number ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td style="padding: 4px 0; color: #a8a29e; font-weight: 700; text-transform: uppercase; font-size: 10px;">Department:</td>
                    <td style="padding: 4px 0; font-weight: 600; color: #44403c;">{{ $studentProfile->Department->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td style="padding: 4px 0; color: #a8a29e; font-weight: 700; text-transform: uppercase; font-size: 10px;">Level:</td>
                    <td style="padding: 4px 0; font-weight: 600; color: #44403c;">{{ $studentProfile->level ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>

        <!-- Meta Details Grid & QR Code Container -->
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 24px;">
            <tr>
                <!-- Left Side: Data Fields -->
                <td style="vertical-align: top; width: 70%;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 6px 0; vertical-align: top; width: 50%;">
                                <p style="margin: 0; font-size: 10px; color: #a8a29e; font-weight: 700; text-transform: uppercase;">Payment ID</p>
                                <p style="margin: 2px 0 0 0; font-size: 13px; font-weight: 600; color: #44403c; word-break: break-all;">{{ $payment->id }}</p>
                            </td>
                            <td style="padding: 6px 0; vertical-align: top; width: 50%;">
                                <p style="margin: 0; font-size: 10px; color: #a8a29e; font-weight: 700; text-transform: uppercase;">Transaction ID</p>
                                <p style="margin: 2px 0 0 0; font-size: 13px; font-weight: 600; color: #44403c; word-break: break-all;">{{ $payment->paypal_transection_id ?? 'N/A' }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 6px 0; vertical-align: top;">
                                <p style="margin: 0; font-size: 10px; color: #a8a29e; font-weight: 700; text-transform: uppercase;">Academic Session</p>
                                <p style="margin: 2px 0 0 0; font-size: 13px; font-weight: 600; color: #44403c;">{{ $payment->session }}</p>
                            </td>
                            <td style="padding: 6px 0; vertical-align: top;">
                                <p style="margin: 0; font-size: 10px; color: #a8a29e; font-weight: 700; text-transform: uppercase;">Status</p>
                                <span style="display: inline-block; margin-top: 4px; padding: 2px 8px; font-size: 10px; font-weight: 800; color: #166534; background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 4px; text-transform: uppercase;">PAID</span>
                            </td>
                        </tr>
                    </table>
                </td>

                <!-- Right Side: Clean Verification QR Box -->
                <td style="vertical-align: top; text-align: right; width: 30%;">
                    <div style="display: inline-block; text-align: center; border: 1px solid #e7e5e4; background-color: #fafaf9; padding: 10px; border-radius: 8px;">
                        <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::size(90)->color(26, 43, 76)->generate(url()->current())) !!}" 
                             alt="Verification QR Code" 
                             style="width: 90px; height: 90px; display: block;" />
                        <span style="display: block; font-size: 8px; font-weight: 700; color: #a8a29e; text-transform: uppercase; margin-top: 6px; letter-spacing: 0.05em;">Verify Receipt</span>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Total Box -->
        <table style="width: 100%; background-color: #1e2d54; color: #ffffff; border-radius: 8px; padding: 16px 20px; margin-bottom: 24px;">
            <tr>
                <td style="font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; color: #cbd5e1;">
                    Total Amount Remitted
                </td>
                <td style="font-size: 20px; font-weight: 900; color: #ffffff; text-align: right;">
                    NGN {{ number_format($payment->amount_paid, 2) }}
                </td>
            </tr>
        </table>

        <!-- Footer -->
        <p style="text-align: center; font-size: 10px; color: #a8a29e; margin: 32px 0 0 0; border-top: 1px solid #e7e5e4; padding-top: 16px; line-height: 1.5;">
            &copy; {{ date('Y') }} CoreStack Institute - Academic Portal.<br>
            This is a secure system-generated document. Verification code embedded.
        </p>
    </div>

</body>
</html>