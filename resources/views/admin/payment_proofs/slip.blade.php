<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Receipt - {{ $paymentProof->submission_id }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Sora:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-primary: #f8fafc;
            --bg-soft: #ffffff;
            --text-primary: #0f172a;
            --text-muted: #64748b;
            --accent-blue: #0e3d81;
            --accent-green: #39b54a;
            --accent-gold: #b45309;
            --accent-danger: #dc2626;
            --border-color: #e2e8f0;
        }

        /* Dark mode values */
        .dark-theme {
            --bg-primary: #050505;
            --bg-soft: #111827;
            --text-primary: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #1f2937;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Manrope', sans-serif;
            background: radial-gradient(circle at top, rgba(14, 61, 129, 0.08), transparent 30%),
                        linear-gradient(180deg, var(--bg-primary) 0%, var(--bg-primary) 100%);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: background 0.2s ease, color 0.2s ease;
        }

        /* Floating action header on screen */
        .action-bar {
            width: 100%;
            max-width: 600px;
            margin: 20px auto 0 auto;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg-soft);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);
            box-sizing: border-box;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-family: 'Sora', sans-serif;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .btn-print {
            background: linear-gradient(135deg, var(--accent-green) 0%, #2c8f3a 100%);
            border: 1px solid rgba(57, 181, 74, 0.2);
            color: white;
            box-shadow: 0 4px 12px rgba(57, 181, 74, 0.25);
        }
        .btn-print:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(57, 181, 74, 0.4);
        }

        .btn-close {
            background: var(--bg-soft);
            border: 1px solid var(--border-color);
            color: var(--text-muted);
        }
        .btn-close:hover {
            background: var(--bg-primary);
            color: var(--text-primary);
        }

        /* Receipt Card Container */
        .receipt-card {
            width: 95%;
            max-width: 550px;
            background: var(--bg-soft);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 40px;
            margin: 30px auto;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.04);
            box-sizing: border-box;
            position: relative;
            overflow: hidden;
            transition: background 0.2s ease, border-color 0.2s ease;
        }

        .receipt-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--accent-blue) 0%, var(--accent-green) 100%);
        }

        /* Receipt Header */
        .header {
            text-align: center;
            margin-bottom: 24px;
        }

        .brand-logo {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 24px;
            background: linear-gradient(135deg, var(--accent-blue) 0%, var(--accent-green) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0 0 6px 0;
            letter-spacing: -0.5px;
        }

        .brand-subtitle {
            font-size: 11px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
            font-weight: 700;
        }

        /* Holographic Status Stamp */
        .status-stamp-wrapper {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .status-stamp {
            border: 3px double;
            font-family: 'Sora', sans-serif;
            font-weight: 850;
            font-size: 18px;
            padding: 6px 20px;
            text-transform: uppercase;
            border-radius: 8px;
            letter-spacing: 3px;
            transform: rotate(-3deg);
        }

        .stamp-approved {
            border-color: var(--accent-green);
            color: var(--accent-green);
            background: rgba(57, 181, 74, 0.04);
        }

        .stamp-pending {
            border-color: var(--accent-gold);
            color: var(--accent-gold);
            background: rgba(180, 83, 9, 0.04);
        }

        .stamp-rejected {
            border-color: var(--accent-danger);
            color: var(--accent-danger);
            background: rgba(220, 38, 38, 0.04);
        }

        /* Info Grid */
        .details-grid {
            border-top: 1px dashed var(--border-color);
            border-bottom: 1px dashed var(--border-color);
            padding: 20px 0;
            margin: 20px 0;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .detail-row:last-child {
            margin-bottom: 0;
        }

        .detail-label {
            color: var(--text-muted);
            font-weight: 500;
        }

        .detail-value {
            color: var(--text-primary);
            font-weight: 700;
            text-align: right;
        }

        /* Items / Pricing Table */
        .pricing-section {
            margin-top: 20px;
        }

        .pricing-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .pricing-row.total {
            border-top: 1px solid var(--border-color);
            padding-top: 16px;
            margin-top: 16px;
            font-size: 16px;
            font-family: 'Sora', sans-serif;
            font-weight: 800;
        }

        .total-amount {
            color: var(--accent-green);
            font-size: 20px;
            font-weight: 800;
        }

        /* Verification block */
        .verification-block {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--bg-primary);
            border-radius: 16px;
            padding: 16px;
            margin-top: 24px;
            border: 1px solid var(--border-color);
        }

        .qr-code {
            width: 80px;
            height: 80px;
            background: white;
            padding: 4px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
            border: 1px solid var(--border-color);
        }

        .qr-code img {
            width: 100%;
            height: 100%;
        }

        .verification-text {
            flex: 1;
            padding-left: 16px;
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .verification-title {
            color: var(--text-primary);
            font-weight: 800;
            font-family: 'Sora', sans-serif;
            margin-bottom: 4px;
        }

        /* Footer terms */
        .receipt-footer {
            text-align: center;
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 24px;
            line-height: 1.6;
            border-top: 1px dashed var(--border-color);
            padding-top: 16px;
        }

        /* Media Print styles - Optimizes receipt for A4 / PDF download */
        @media print {
            body {
                background: #ffffff !important;
                color: #000000 !important;
                font-size: 12pt;
                padding: 0;
                margin: 0;
            }

            .action-bar {
                display: none !important;
            }

            .receipt-card {
                width: 100%;
                max-width: 100%;
                background: none !important;
                border: none !important;
                box-shadow: none !important;
                margin: 0;
                padding: 0;
            }

            .receipt-card::before {
                display: none;
            }

            .brand-logo {
                background: none !important;
                -webkit-text-fill-color: initial !important;
                color: #000000 !important;
            }

            .brand-subtitle, .detail-label, .verification-text, .receipt-footer {
                color: #555555 !important;
            }

            .detail-value, .pricing-row, .total {
                color: #000000 !important;
            }

            .total-amount {
                color: #000000 !important;
                font-weight: bold;
            }

            .details-grid {
                border-top: 1px dashed #000000 !important;
                border-bottom: 1px dashed #000000 !important;
            }

            .pricing-row.total {
                border-top: 1px solid #000000 !important;
            }

            .verification-block {
                background: #f5f5f5 !important;
                border: 1px solid #dddddd !important;
            }

            .qr-code {
                box-shadow: none !important;
                border: 1px solid #cccccc;
            }
        }
    </style>
</head>
<body>

    <!-- Floating actions -->
    <div class="action-bar">
        <a href="javascript:window.close();" class="btn btn-close">
            <i class="fas fa-times mr-2"></i> Close Slip
        </a>
        <button onclick="window.print();" class="btn btn-print">
            <i class="fas fa-print mr-2"></i> Print & Download PDF
        </button>
    </div>

    <!-- Receipt -->
    <div class="receipt-card">
        <div class="header">
            <h1 class="brand-logo">GMC SESSIONS</h1>
            <p class="brand-subtitle">Official Transaction Slip</p>
        </div>

        <div class="status-stamp-wrapper">
            @if($paymentProof->status === 'approved')
                <div class="status-stamp stamp-approved">APPROVED</div>
            @elseif($paymentProof->status === 'rejected')
                <div class="status-stamp stamp-rejected">REJECTED</div>
            @else
                <div class="status-stamp stamp-pending">PENDING</div>
            @endif
        </div>

        <div class="details-grid">
            <div class="detail-row">
                <span class="detail-label">Receipt Number</span>
                <span class="detail-value font-mono" style="font-weight: 800;">{{ strtoupper($paymentProof->submission_id) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Transaction Date</span>
                <span class="detail-value">{{ $paymentProof->created_at->format('M d, Y H:i:s') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Student Name</span>
                <span class="detail-value">{{ $paymentProof->full_name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Student Email</span>
                <span class="detail-value">{{ $paymentProof->email }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Payment Method</span>
                <span class="detail-value">{{ $paymentProof->payment_method }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Transaction Reference</span>
                <span class="detail-value" style="font-family: monospace;">{{ $paymentProof->transaction_reference }}</span>
            </div>
        </div>

        <div class="pricing-section">
            <div class="pricing-row">
                <span class="detail-label">Session Allocation</span>
                <span class="detail-value">{{ $paymentProof->session_type }}</span>
            </div>
            <div class="pricing-row">
                <span class="detail-label">Program Allocation</span>
                <span class="detail-value">
                    @php
                        $names = [
                            'prog_fullstack_web' => 'Full-Stack Web Development',
                            'prog_data_analytics' => 'Data Analytics Masterclass',
                            'prog_uiux_design' => 'UI/UX Product Design',
                            'prog_mobile_app' => 'Mobile App Development (React Native)'
                        ];
                        echo $names[$paymentProof->program_id] ?? ucwords(str_replace('_', ' ', $paymentProof->program_id));
                    @endphp
                </span>
            </div>
            <div class="pricing-row.total pricing-row total">
                <span class="detail-label">Grand Total Verified</span>
                <span class="total-amount">${{ number_format($paymentProof->amount_paid, 2) }}</span>
            </div>
        </div>

        <div class="verification-block">
            <div class="qr-code">
                <!-- QR Code generating tool referencing submission -->
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode(route('payment-proofs.show', $paymentProof->id)) }}" alt="Verification QR Code">
            </div>
            <div class="verification-text">
                <div class="verification-title">Security Verified</div>
                This is a digitally verified receipt issued by GMC Session Management. Scan the QR code with any camera device to authenticate the student credentials and transaction records instantly.
            </div>
        </div>

        <div class="receipt-footer">
            Thank you for enrolling! For queries regarding your mentors, schedule allocations, or syllabus credentials, contact our support division at support@gmc.edu.pk.
            <br><br>
            © {{ date('Y') }} GMC Sessions. All rights reserved.
        </div>
    </div>

    <script>
        // Check active theme state of opener window
        if (window.opener && window.opener.document.documentElement.classList.contains('dark')) {
            document.body.classList.add('dark-theme');
        } else if (localStorage.theme === 'dark') {
            document.body.classList.add('dark-theme');
        }
        
        // Trigger print dialog automatically when loaded as a printing request
        window.addEventListener('DOMContentLoaded', () => {
            if (window.location.search.includes('print=true')) {
                setTimeout(() => {
                    window.print();
                }, 500);
            }
        });
    </script>
</body>
</html>
