<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index()
    {
        $sections = [
            'Information We Collect' => 'We collect information you provide directly to us (name, email, shipping address, payment information) when you create an account, place an order, or contact us. We also collect usage data (pages visited, clicks, device type) automatically through cookies and analytics tools.',
            'How We Use Your Information' => 'We use your information to process orders, send confirmations and shipping updates, respond to enquiries, personalise your experience, send promotional emails (where you have opted in), and improve our services.',
            'Sharing of Information' => 'We do not sell your personal information. We share data only with trusted service providers (payment processors, shipping partners, email platforms) who are bound by confidentiality agreements and may not use your data for their own purposes.',
            'Cookies' => 'We use essential cookies to keep your cart and session active, and optional analytics cookies to understand how our site is used. You can manage cookie preferences in your browser settings at any time.',
            'Data Retention' => 'We retain your account and order data for as long as your account is active, or as required by law. You may request deletion of your data at any time by contacting us.',
            'Your Rights' => 'You have the right to access, correct, or delete your personal data. You may also opt out of marketing communications at any time via the unsubscribe link in any email or by contacting our support team.',
            'Security' => 'We implement industry-standard security measures including TLS encryption, hashed passwords, and PCI-compliant payment processing. No system is 100% secure, so we encourage strong, unique passwords.',
            'Contact Us' => 'If you have questions about this Privacy Policy, please contact us at privacy@luxeshop.com or via our contact page.',
        ];
        return view("user.pages.privacy", ["sections" => $sections]);
    }
}
