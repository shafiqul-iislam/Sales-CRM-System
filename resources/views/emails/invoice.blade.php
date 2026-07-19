<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
</head>
<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f3f4f6; margin: 0; padding: 40px 0;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
        
        <!-- Header -->
        <table width="100%" cellpadding="0" cellspacing="0" style="border-bottom: 2px solid #e5e7eb; padding-bottom: 20px; margin-bottom: 30px;">
            <tr>
                <td>
                    <h1 style="color: #059669; font-size: 28px; margin: 0;">Sales CRM</h1>
                    <p style="color: #6b7280; font-size: 14px; margin: 5px 0 0 0;">Thank you for your purchase!</p>
                </td>
                <td align="right">
                    <h2 style="color: #111827; font-size: 20px; margin: 0;">INVOICE</h2>
                    <p style="color: #6b7280; font-size: 14px; margin: 5px 0 0 0;">#INV-{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</p>
                    <p style="color: #6b7280; font-size: 14px; margin: 5px 0 0 0;">{{ \Carbon\Carbon::parse($sale->sale_date)->format('M d, Y') }}</p>
                </td>
            </tr>
        </table>

        <!-- Billed To -->
        <div style="margin-bottom: 40px;">
            <h3 style="color: #374151; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 10px 0;">Billed To:</h3>
            <p style="color: #111827; font-size: 16px; font-weight: bold; margin: 0 0 5px 0;">{{ $sale->customer->name }}</p>
            <p style="color: #4b5563; font-size: 15px; margin: 0 0 5px 0;">{{ $sale->customer->email }}</p>
            @if($sale->customer->address)
                <p style="color: #4b5563; font-size: 15px; margin: 0;">{{ $sale->customer->address }}</p>
            @endif
        </div>

        <!-- Items Table -->
        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 30px; border-collapse: collapse;">
            <thead>
                <tr>
                    <th align="left" style="padding: 12px 8px; border-bottom: 2px solid #e5e7eb; color: #374151; font-size: 14px; text-transform: uppercase;">Description</th>
                    <th align="center" style="padding: 12px 8px; border-bottom: 2px solid #e5e7eb; color: #374151; font-size: 14px; text-transform: uppercase;">Qty</th>
                    <th align="right" style="padding: 12px 8px; border-bottom: 2px solid #e5e7eb; color: #374151; font-size: 14px; text-transform: uppercase;">Price</th>
                    <th align="right" style="padding: 12px 8px; border-bottom: 2px solid #e5e7eb; color: #374151; font-size: 14px; text-transform: uppercase;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->saleItems as $item)
                <tr>
                    <td style="padding: 16px 8px; border-bottom: 1px solid #f3f4f6; color: #111827; font-size: 15px;">
                        {{ optional($item->product)->name ?? 'Unknown Product' }}
                    </td>
                    <td align="center" style="padding: 16px 8px; border-bottom: 1px solid #f3f4f6; color: #4b5563; font-size: 15px;">
                        {{ $item->quantity }}
                    </td>
                    <td align="right" style="padding: 16px 8px; border-bottom: 1px solid #f3f4f6; color: #4b5563; font-size: 15px;">
                        ${{ number_format($item->unit_price, 2) }}
                    </td>
                    <td align="right" style="padding: 16px 8px; border-bottom: 1px solid #f3f4f6; color: #111827; font-size: 15px; font-weight: bold;">
                        ${{ number_format($item->subtotal, 2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td width="60%"></td>
                <td width="40%">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="right" style="padding: 8px 0; color: #4b5563; font-size: 15px;">Subtotal:</td>
                            <td align="right" style="padding: 8px 0; color: #111827; font-size: 15px; font-weight: bold;">${{ number_format($sale->total_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <td align="right" style="padding: 16px 0; color: #111827; font-size: 18px; font-weight: bold; border-top: 2px solid #e5e7eb;">Total Amount:</td>
                            <td align="right" style="padding: 16px 0; color: #059669; font-size: 18px; font-weight: bold; border-top: 2px solid #e5e7eb;">${{ number_format($sale->total_amount, 2) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Footer -->
        <div style="margin-top: 50px; text-align: center; border-top: 1px solid #e5e7eb; padding-top: 30px;">
            <p style="color: #6b7280; font-size: 14px; margin: 0;">If you have any questions about this invoice, please contact us.</p>
            <p style="color: #9ca3af; font-size: 12px; margin: 10px 0 0 0;">&copy; {{ date('Y') }} Sales CRM. All rights reserved.</p>
        </div>
        
    </div>
</body>
</html>
