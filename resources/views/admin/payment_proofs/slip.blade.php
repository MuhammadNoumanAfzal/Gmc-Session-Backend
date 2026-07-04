<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMC Transaction Receipt - {{ $paymentProof->submission_id }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime:wght@400;700&family=Manrope:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-primary: #f1f5f9;
            --bg-soft: #ffffff;
            --text-primary: #0f172a;
            --text-muted: #475569;
            --accent-blue: #0e3d81;
            --accent-green: #15803d;
            --accent-green-light: #f0fdf4;
            --accent-gold: #b45309;
            --accent-gold-light: #fffbeb;
            --accent-danger: #b91c1c;
            --accent-danger-light: #fef2f2;
            --border-color: #cbd5e1;
            --card-shadow: 0 15px 30px -10px rgba(15, 23, 42, 0.1);
        }

        .dark-theme {
            --bg-primary: #090d16;
            --bg-soft: #111827;
            --text-primary: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #374151;
            --accent-blue-light: rgba(56, 189, 248, 0.03);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Manrope', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 10px;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        /* Sleek Floating Header Controls */
        .action-header {
            width: 100%;
            max-width: 380px;
            padding: 8px 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--bg-soft);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 16px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: 11px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .btn-print {
            background: linear-gradient(135deg, var(--accent-blue) 0%, #0a2d5e 100%);
            color: white;
            border: none;
            box-shadow: 0 4px 10px rgba(14, 61, 129, 0.2);
        }
        .btn-print:hover {
            opacity: 0.95;
            transform: translateY(-0.5px);
        }

        .btn-close {
            background-color: var(--bg-soft);
            border: 1px solid var(--border-color);
            color: var(--text-muted);
        }
        .btn-close:hover {
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }

        /* Thermal Ticket Receipt Card */
        .invoice-container {
            width: 100%;
            max-width: 380px;
            background-color: var(--bg-soft);
            border: 1px solid var(--border-color);
            border-radius: 16px 16px 0 0;
            padding: 24px 20px 32px 20px;
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
            transition: background-color 0.2s ease;
        }

        /* Ticket Top Colored Strip */
        .invoice-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-blue) 0%, var(--accent-green) 100%);
        }

        /* CSS-based jagged receipt tear bottom edge */
        .invoice-container::after {
            content: "";
            display: block;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 10px;
            background: linear-gradient(-45deg, var(--bg-primary) 5px, transparent 0),
                        linear-gradient(45deg, var(--bg-primary) 5px, transparent 0);
            background-size: 10px 10px;
        }

        /* Header block containing Logo & Title */
        .invoice-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-symbol {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-blue) 0%, var(--accent-green) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            margin-bottom: 8px;
            box-shadow: 0 4px 8px rgba(14, 61, 129, 0.1);
        }

        .brand-name {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 15px;
            color: var(--text-primary);
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .brand-tagline {
            font-size: 9px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        /* Status Badge Pill */
        .status-badge {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 10px;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .status-badge.approved {
            background-color: var(--accent-green-light);
            border-color: rgba(21, 128, 61, 0.2);
            color: var(--accent-green);
        }

        .status-badge.pending {
            background-color: var(--accent-gold-light);
            border-color: rgba(180, 83, 9, 0.2);
            color: var(--accent-gold);
        }

        .status-badge.rejected {
            background-color: var(--accent-danger-light);
            border-color: rgba(185, 28, 28, 0.2);
            color: var(--accent-danger);
        }

        /* Separator dotted line */
        .divider {
            border: none;
            border-top: 1.5px dashed var(--border-color);
            margin: 16px 0;
            height: 0;
        }

        /* Detail List */
        .details-section {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            font-size: 12px;
        }

        .info-label {
            color: var(--text-muted);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .info-label i {
            width: 14px;
            color: var(--accent-blue);
            text-align: center;
        }

        .info-value {
            color: var(--text-primary);
            font-weight: 750;
            text-align: right;
            max-width: 60%;
        }

        .font-mono-val {
            font-family: 'Courier Prime', monospace;
            font-weight: 700;
            font-size: 12.5px;
        }

        /* Premium Total Section */
        .cost-section {
            background: var(--accent-blue-light);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 14px;
            text-align: center;
            margin: 16px 0;
            position: relative;
        }

        .cost-label {
            font-family: 'Sora', sans-serif;
            font-weight: 850;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .cost-amount {
            font-family: 'Sora', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: var(--accent-green);
            letter-spacing: -0.5px;
        }

        /* Bottom Security Block */
        .security-block {
            display: flex;
            align-items: center;
            gap: 14px;
            background-color: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 20px;
        }

        .qr-box {
            background-color: white;
            padding: 4px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            width: 64px;
            height: 64px;
            flex-shrink: 0;
        }

        .qr-box img {
            width: 100%;
            height: 100%;
        }

        .security-details {
            font-size: 10.5px;
            line-height: 1.4;
            color: var(--text-muted);
        }

        .security-title {
            font-family: 'Sora', sans-serif;
            color: var(--text-primary);
            font-weight: 800;
            margin-bottom: 2px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .security-title i {
            color: var(--accent-green);
        }

        /* Stamp overlay styling */
        .stamp-section {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 12px;
            height: 48px;
            position: relative;
        }

        .stamp-badge {
            position: absolute;
            top: -20px;
            right: 20px;
            width: 58px;
            height: 58px;
            opacity: 0.35;
            pointer-events: none;
        }

        .stamp-label {
            font-size: 9.5px;
            color: var(--text-muted);
            font-weight: 700;
            border-top: 1.5px solid var(--text-primary);
            padding-top: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Footer contact card */
        .support-card {
            text-align: center;
            font-size: 9px;
            color: var(--text-muted);
            line-height: 1.5;
            margin-top: 16px;
        }

        /* ------------------------------------------------------------- */
        /* MEDIA PRINT STYLES - Optimized receipt ticket */
        /* ------------------------------------------------------------- */
        @media print {
            @page {
                size: portrait;
                margin: 5mm;
            }

            body {
                background-color: #ffffff !important;
                color: #000000 !important;
                padding: 0 !important;
            }

            .action-header {
                display: none !important;
            }

            .invoice-container {
                width: 100% !important;
                max-width: 320px !important;
                background-color: #ffffff !important;
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                margin: 0 auto !important;
            }

            .invoice-container::before, .invoice-container::after {
                display: none;
            }

            .brand-name, .security-title {
                color: #000000 !important;
            }

            .info-label, .security-details, .support-card, .stamp-label, .brand-tagline {
                color: #444444 !important;
            }

            .info-value, .cost-label {
                color: #000000 !important;
            }

            .cost-section {
                background-color: #f8fafc !important;
                border: 1px solid #cbd5e1 !important;
            }

            .cost-amount {
                color: #000000 !important;
                font-weight: bold;
                font-size: 18pt;
            }

            .qr-box {
                border: 1px solid #94a3b8 !important;
            }

            .status-badge.approved {
                background-color: #f0fdf4 !important;
                border-color: #bbf7d0 !important;
                color: #166534 !important;
            }
            .status-badge.pending {
                background-color: #fffbeb !important;
                border-color: #fef3c7 !important;
                color: #92400e !important;
            }
            .status-badge.rejected {
                background-color: #fef2f2 !important;
                border-color: #fee2e2 !important;
                color: #991b1b !important;
            }
        }
    </style>
</head>
<body>

    <!-- Floating header controls -->
    <div class="action-header">
        <a href="javascript:window.close();" class="btn btn-close">
            <i class="fas fa-times"></i> Close Slip
        </a>
        <button onclick="window.print();" class="btn btn-print">
            <i class="fas fa-print"></i> Print / Save
        </button>
    </div>

    <!-- Ticket Slip -->
    <div class="invoice-container">
        
        <!-- Header -->
        <div class="invoice-header">
            <div class="logo-symbol">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <h1 class="brand-name">GMC SESSIONS</h1>
            <p class="brand-tagline">Global Minds Consultants</p>
            
            @if($paymentProof->status === 'approved')
                <div class="status-badge approved">
                    <i class="fa-solid fa-circle-check"></i> Approved
                </div>
            @elseif($paymentProof->status === 'rejected')
                <div class="status-badge rejected">
                    <i class="fa-solid fa-circle-xmark"></i> Rejected
                </div>
            @else
                <div class="status-badge pending">
                    <i class="fa-solid fa-hourglass-half"></i> Pending
                </div>
            @endif
        </div>

        <hr class="divider">

        <!-- Student & Payment details -->
        <div class="details-section">
            <div class="info-row">
                <span class="info-label"><i class="fa-solid fa-ticket"></i> Receipt ID</span>
                <span class="info-value font-mono-val">{{ strtoupper($paymentProof->submission_id) }}</span>
            </div>
            
            <div class="info-row">
                <span class="info-label"><i class="fa-solid fa-calendar-day"></i> Date Issued</span>
                <span class="info-value">{{ $paymentProof->created_at->format('M d, Y') }}</span>
            </div>
            
            <div class="info-row">
                <span class="info-label"><i class="fa-solid fa-user-graduate"></i> Student</span>
                <span class="info-value">{{ $paymentProof->full_name }}</span>
            </div>
            
            <div class="info-row">
                <span class="info-label"><i class="fa-solid fa-graduation-cap"></i> Program</span>
                <span class="info-value">
                    @php
                        $names = [
                            'prog_fullstack_web' => 'Full-Stack Web Dev',
                            'prog_data_analytics' => 'Data Analytics',
                            'prog_uiux_design' => 'UI/UX Product Design',
                            'prog_mobile_app' => 'Mobile App Dev'
                        ];
                        echo $names[$paymentProof->program_id] ?? ucwords(str_replace('_', ' ', $paymentProof->program_id));
                    @endphp
                </span>
            </div>
            
            <div class="info-row">
                <span class="info-label"><i class="fa-solid fa-circle-nodes"></i> Category</span>
                <span class="info-value">{{ $paymentProof->session_type }}</span>
            </div>
            
            <div class="info-row">
                <span class="info-label"><i class="fa-solid fa-wallet"></i> Method</span>
                <span class="info-value">{{ ucwords(str_replace('_', ' ', $paymentProof->payment_method)) }}</span>
            </div>
            
            <div class="info-row">
                <span class="info-label"><i class="fa-solid fa-hashtag"></i> Reference ID</span>
                <span class="info-value font-mono-val" style="font-size: 11.5px; opacity: 0.85;">{{ $paymentProof->transaction_reference }}</span>
            </div>
        </div>

        <hr class="divider">

        <!-- Grand Total Banner -->
        <div class="cost-section">
            <div class="cost-label">Total Verified Amount</div>
            <div class="cost-amount">${{ number_format($paymentProof->amount_paid, 2) }}</div>
        </div>

        <!-- Security Seal Block -->
        <div class="security-block">
            <div class="qr-box">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ urlencode(route('payment-proofs.show', $paymentProof->id)) }}" alt="Verification QR Code">
            </div>
            
            <div class="security-details">
                <h4 class="security-title"><i class="fa-solid fa-shield-halved"></i> Audited Voucher</h4>
                Scan the QR code to confirm credentials and authenticate transaction against the GMC database registry.
            </div>
        </div>

        <!-- Digital Stamp Overlay -->
        <div class="stamp-section">
            @if($paymentProof->status === 'approved')
                <div class="stamp-badge">
                    <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="45" stroke="#15803d" stroke-width="4" stroke-dasharray="6 2"/>
                        <text x="50" y="47" fill="#15803d" font-family="'Sora', sans-serif" font-weight="900" font-size="12" text-anchor="middle" transform="rotate(-12, 50, 50)">GMC</text>
                        <text x="50" y="62" fill="#15803d" font-family="'Sora', sans-serif" font-weight="900" font-size="9" text-anchor="middle" transform="rotate(-12, 50, 50)">APPROVED</text>
                    </svg>
                </div>
            @endif
            <span class="stamp-label">Accounts Auditor</span>
        </div>

        <!-- Footer -->
        <div class="support-card">
            For support queries, contact us at: support@gmc.edu.pk
            <br>
            © {{ date('Y') }} Global Minds Consultants Pvt. Ltd.
        </div>
    </div>

    <!-- Theme State Script -->
    <script>
        if (window.opener && window.opener.document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.add('dark-theme');
        } else if (localStorage.theme === 'dark') {
            document.documentElement.classList.add('dark-theme');
        }
    </script>
</body>
</html>
