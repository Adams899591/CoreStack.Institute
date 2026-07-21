<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Slip Proportional Breakdown Matrix</title>
</head>
<body style="background-color: #f9f9f8; color: #44403c; font-family: 'DejaVu Sans', sans-serif; -webkit-font-smoothing: antialiased; padding: 24px; margin: 0;">

    <div style="max-w: 768px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border: 1px solid #e7e5e4; overflow: hidden; display: flex; flex-direction: column;">
        
        <!-- Header Section (Centered Layout) -->
        <div style="background-color: #ffffff; padding: 24px; border-bottom: 1px solid #e7e5e4; text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <!-- School Logo -->
            <img src="{{public_path('image/core-stack.png')}}" alt="CoreStack Logo" style="width: 56px; height: 56px; border-radius: 50%; object-fit: cover; border: 2px solid #e7e5e4; margin-bottom: 10px;" />
            
            <!-- School Name & Subtitle -->
            <h1 style="margin: 0; font-size: 16px; font-weight: 800; color: #1e2d54; text-transform: uppercase; letter-spacing: 0.05em;">CoreStack Academy</h1>
            <p style="margin: 4px 0 10px 0; font-size: 11px; color: #d97706; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Fee Breakdown & Verification Portal</p>
            
            <!-- Session & Ref Meta -->
            <div style="display: flex; gap: 12px; align-items: center; font-size: 10px; text-transform: uppercase; letter-spacing: 0.05em;">
                <span style="font-weight: 700; color: #1e2d54;">Session: {{ $payment->session }}</span>
                <span style="color: #cbd5e1;">|</span>
                <span style="color: #a8a29e;">Ref: {{ $payment->id }}</span>
            </div>
        </div>

        <!-- Table Container -->
        <div style="overflow-x: auto;">
            <table style="width: 100%; font-size: 12px; text-align: left; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f5f5f4; color: #57534e; font-weight: 700; text-transform: uppercase; font-size: 10px; border-bottom: 1px solid #e7e5e4;">
                        <th style="padding: 12px 24px; width: 64px; text-align: center;">S/N</th>
                        <th style="padding: 12px 24px;">Item Description</th>
                        <th style="padding: 12px 24px; text-align: right;">Amount</th>
                    </tr>
                </thead>
                <tbody style="color: #44403c;">
                    @foreach ($breakdown as $index => $item)
                        <tr style="border-bottom: 1px solid #e7e5e4;">
                            <td style="padding: 12px 24px; text-align: center; font-weight: 500; color: #a8a29e;">{{ $index + 1 }}</td>
                            <td style="padding: 12px 24px;">{{ $item['name'] }}</td>
                            <td style="padding: 12px 24px; text-align: right; font-weight: 600;">
                                <img src="{{public_path('image/naria.png')}}" alt="₦" style="height: 12px; width: auto; vertical-align: middle; margin-right: 2px;" />
                                {{ number_format($item['amount'], 2) }}
                            </td>
                        </tr>  
                    @endforeach
                </tbody>
                <tfoot style="background-color: #fafaf9; border-top: 2px solid #e7e5e4; font-weight: 700; color: #1e2d54;">
                    <tr>
                        <td colspan="2" style="padding: 16px 24px; text-align: right; text-transform: uppercase; letter-spacing: 0.05em; font-size: 10px;">Cumulative Total:</td>
                        <td style="padding: 16px 24px; text-align: right; font-size: 16px; font-weight: 900; color: #1c1917;">
                            <img src="{{public_path('image/naria.png')}}" alt="₦" style="height: 15px; width: auto; vertical-align: middle; margin-right: 2px;" />
                            {{ number_format($payment->amount_paid, 2) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Simple Clean PDF Footer -->
        <div style="padding: 16px 24px; background-color: #fafaf9; border-top: 1px solid #e7e5e4; text-align: center; font-size: 11px; color: #a8a29e;">
            &copy; {{ date('Y') }} CoreStack Institute - Academic Portal Breakdown Verification
        </div>
    </div>

</body>
</html>