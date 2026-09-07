<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="format-detection" content="telephone=no">
    <title>Travelingin.id | Explore the World in Luxury</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #0A192F;
            --primary-light: #112240;
            --accent: #D4AF37;
            --accent-light: #E5C76B;
            --white: #FFFFFF;
            --bg-light: #FDFDFD;
            --bg-gray: #F8F9FA;
            --text-main: #1D1D1F;
            --text-muted: #6E6E73;
            --font-heading: 'Playfair Display', serif;
            --font-body: 'Plus Jakarta Sans', sans-serif;
            --transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --glass: rgba(255, 255, 255, 0.7);
            --glass-dark: rgba(10, 25, 47, 0.8);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
            width: 100%;
            max-width: 100vw;
            overflow-x: hidden;
        }

        body {
            font-family: var(--font-body);
            color: var(--text-main);
            background-color: var(--bg-light);
            line-height: 1.7;
            width: 100%;
            max-width: 100vw;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            color: var(--primary);
            font-weight: 700;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
        }

        ul {
            list-style: none;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 32px;
            border-radius: 100px;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent), #B8860B);
            color: var(--white);
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 25px rgba(212, 175, 55, 0.4);
            background: linear-gradient(135deg, #B8860B, var(--accent));
        }

        .btn-outline {
            background: transparent;
            color: var(--white);
            border: 1.5px solid rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(5px);
        }

        .btn-outline:hover {
            background: var(--white);
            color: var(--primary);
            border-color: var(--white);
            transform: translateY(-3px);
        }

        .btn-dark-outline {
            background: transparent;
            color: var(--primary);
            border: 1.5px solid var(--primary);
        }

        .btn-dark-outline:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-3px);
        }

        /* Navbar */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 30px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        nav.scrolled {
            padding: 15px 5%;
            background: var(--glass);
            backdrop-filter: blur(15px) saturate(180%);
            -webkit-backdrop-filter: blur(15px) saturate(180%);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .logo {
            font-family: var(--font-heading);
            font-size: 28px;
            font-weight: 800;
            color: var(--white);
        }

        nav.scrolled .logo {
            color: var(--primary);
        }

        .nav-links {
            display: flex;
            gap: 40px;
        }

        .nav-links a {
            color: var(--white);
            font-weight: 500;
            font-size: 0.95rem;
            opacity: 0.9;
        }

        nav.scrolled .nav-links a {
            color: var(--primary);
        }

        .nav-links a:hover {
            color: var(--accent);
            opacity: 1;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .login-link {
            color: var(--white);
            font-weight: 600;
        }

        nav.scrolled .login-link {
            color: var(--primary);
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: var(--primary);
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.6;
            transform: scale(1.1);
            animation: slowZoom 20s infinite alternate;
        }

        @keyframes slowZoom {
            from { transform: scale(1); }
            to { transform: scale(1.15); }
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(10, 25, 47, 0.4), rgba(10, 25, 47, 0.8));
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: var(--white);
            max-width: 900px;
            padding: 0 20px;
        }

        .hero h1 {
            font-size: clamp(3rem, 8vw, 5.5rem);
            color: var(--white);
            line-height: 1.1;
            margin-bottom: 25px;
            letter-spacing: -1px;
        }

        .hero p {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 45px;
            font-weight: 300;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-btns {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        /* Section Global */
        section {
            padding: 120px 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .section-header span {
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 0.85rem;
            font-weight: 700;
            display: block;
            margin-bottom: 15px;
        }

        .section-header h2 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 20px;
            background: linear-gradient(rgba(10, 25, 47, 0.6), rgba(10, 25, 47, 0.6)), url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
        }

        .hero-content {
            max-width: 800px;
            color: var(--white);
            z-index: 1;
            animation: fadeIn 1.5s ease-out;
        }

        .hero h1 {
            font-size: 4.5rem;
            color: var(--white);
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 40px;
            font-weight: 300;
        }

        .hero-btns {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Section Global */
        section {
            padding: 100px 5%;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .section-header p {
            color: var(--text-muted);
            max-width: 650px;
            margin: 0 auto;
            font-size: 1.1rem;
        }

        /* Travel Categories */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }

        .category-card {
            position: relative;
            height: 550px;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            cursor: pointer;
        }

        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .category-card:hover img {
            transform: scale(1.1);
        }

        .category-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(10, 25, 47, 0.9), transparent 70%);
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            color: var(--white);
            transition: var(--transition);
        }

        .category-card:hover .category-overlay {
            background: linear-gradient(to top, rgba(10, 25, 47, 0.95), transparent 80%);
        }

        .category-overlay h3 {
            color: var(--white);
            font-size: 2.2rem;
            margin-bottom: 15px;
        }

        .category-overlay p {
            font-size: 1rem;
            opacity: 0.8;
            margin-bottom: 30px;
            max-width: 400px;
            transform: translateY(20px);
            transition: var(--transition);
        }

        .category-card:hover .category-overlay p {
            transform: translateY(0);
            opacity: 1;
        }

        /* Featured Destinations */
        .destinations-section {
            background-color: var(--bg-gray);
        }

        .dest-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
        }

        .dest-card {
            background: var(--white);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0,0,0,0.03);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .dest-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .dest-img-container {
            height: 280px;
            overflow: hidden;
            position: relative;
        }

        .dest-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .dest-card:hover img {
            transform: scale(1.1);
        }

        .dest-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--glass);
            backdrop-filter: blur(10px);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary);
            z-index: 1;
        }

        .dest-info {
            padding: 30px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .dest-info h3 {
            font-size: 1.4rem;
            margin-bottom: 12px;
        }

        .dest-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .dest-price {
            display: flex;
            align-items: baseline;
            gap: 8px;
        }

        .dest-price .amount {
            color: var(--accent);
            font-size: 1.5rem;
            font-weight: 800;
            font-family: var(--font-body);
        }

        .dest-price .label {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        /* Features Section */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .feature-item {
            padding: 40px;
            background: var(--white);
            border-radius: 24px;
            box-shadow: var(--shadow-sm);
            text-align: center;
            transition: var(--transition);
        }

        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: rgba(212, 175, 55, 0.1);
            color: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 25px;
        }

        /* Testimonials */
        .testi-card {
            background: var(--white);
            padding: 50px;
            border-radius: 30px;
            box-shadow: var(--shadow-md);
            position: relative;
        }

        .testi-text {
            font-size: 1.1rem;
            font-style: italic;
            margin-bottom: 30px;
            color: var(--text-main);
            position: relative;
            z-index: 1;
        }

        .testi-user {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .testi-user img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .testi-user h4 {
            font-size: 1.1rem;
            margin-bottom: 4px;
        }

        .testi-user span {
            color: var(--accent);
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(rgba(10, 25, 47, 0.85), rgba(10, 25, 47, 0.85)), url('https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover fixed;
            padding: 150px 0;
            text-align: center;
            color: var(--white);
        }

        .cta-section h2 {
            color: var(--white);
            font-size: 3.5rem;
            margin-bottom: 25px;
        }

        .cta-section p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 45px;
            opacity: 0.9;
        }

        /* Footer */
        footer {
            background-color: var(--primary);
            color: var(--white);
            padding: 100px 0 40px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 60px;
            margin-bottom: 80px;
        }

        .footer-col h4 {
            color: var(--white);
            font-size: 1.1rem;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .footer-links li {
            margin-bottom: 15px;
        }

        .footer-links a {
            color: rgba(255,255,255,0.6);
            font-size: 0.95rem;
        }

        .footer-links a:hover {
            color: var(--accent);
            padding-left: 8px;
        }

        .social-links {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }

        .social-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: var(--transition);
        }

        .social-icon:hover {
            background: var(--accent);
            transform: translateY(-5px);
            color: var(--primary);
        }

        .footer-bottom {
            padding-top: 40px;
            border-top: 1px solid rgba(255,255,255,0.05);
            text-align: center;
            color: rgba(255,255,255,0.4);
            font-size: 0.9rem;
        }

        /* Dropdown */
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: var(--white);
            min-width: 220px;
            box-shadow: var(--shadow-lg);
            border-radius: 16px;
            z-index: 1000;
            overflow: hidden;
            margin-top: 20px;
            border: 1px solid rgba(0,0,0,0.05);
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-content a {
            color: var(--primary) !important;
            padding: 14px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .dropdown-content a:hover {
            background-color: var(--bg-gray);
            color: var(--accent) !important;
        }

        .dropdown-content.show {
            display: block;
        }

        /* Mobile Menu Styles */
        .mobile-toggle {
            display: none;
            background: transparent;
            border: none;
            color: var(--white);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 8px;
            z-index: 1001;
        }

        nav.scrolled .mobile-toggle {
            color: var(--primary);
        }

        .mobile-drawer {
            position: fixed;
            top: 0;
            right: -100%;
            width: 85%;
            max-width: 360px;
            height: 100vh;
            background: var(--primary);
            z-index: 9999;
            padding: 90px 30px 40px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            transition: right 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: -10px 0 30px rgba(0,0,0,0.3);
        }

        .mobile-drawer.open {
            right: 0;
        }

        .mobile-drawer a {
            color: var(--white);
            font-size: 1.1rem;
            font-weight: 600;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .mobile-drawer-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(10, 25, 47, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9998;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .mobile-drawer-backdrop.open {
            opacity: 1;
            visibility: visible;
        }

        @media (max-width: 992px) {
            .nav-links { display: none !important; }
            .mobile-toggle { display: block !important; }
            .nav-actions > *:not(.mobile-toggle) { display: none !important; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .hero h1 { font-size: 2.4rem; }
            .user-name { display: none !important; }
        }

        @media (max-width: 768px) {
            nav { padding: 15px 5% !important; }
            nav.scrolled { padding: 10px 5% !important; }
            .logo img { max-height: 40px !important; }
            .mobile-toggle { font-size: 1.8rem; padding: 4px; }
            .hero { padding: 80px 0 40px; text-align: center; }
            .hero h1 { font-size: 2rem !important; line-height: 1.2; margin-bottom: 16px; }
            .hero p { font-size: 0.95rem !important; margin-bottom: 24px; line-height: 1.5; }
            .hero-btns { flex-direction: column; width: 100%; gap: 12px; }
            .hero-btns .btn { width: 100%; padding: 14px 20px !important; font-size: 0.9rem !important; }
            .btn { padding: 12px 20px !important; font-size: 0.9rem !important; }
            .footer-grid { grid-template-columns: 1fr; gap: 30px; }
            
            /* 2 Columns on Mobile */
            .categories-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
            .dest-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
            
            .category-card { height: 180px !important; border-radius: 12px !important; }
            .category-overlay { padding: 12px !important; }
            .category-overlay h3 { font-size: 1rem !important; margin-bottom: 5px !important; line-height: 1.2; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
            .category-overlay p { display: none; }
            .category-overlay .btn { padding: 4px 8px !important; font-size: 0.7rem !important; width: 100% !important; border-radius: 6px !important; }
            
            .dest-card { border-radius: 12px !important; }
            .dest-img-wrap { height: 120px !important; }
            .dest-info { padding: 12px !important; }
            .dest-info h3 { font-size: 0.95rem !important; margin-bottom: 5px !important; line-height: 1.2; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
            .dest-meta { flex-direction: column; align-items: flex-start !important; gap: 4px !important; font-size: 0.7rem !important; margin-bottom: 8px !important; }
            .dest-info > div[style*="flex"] { flex-direction: column !important; align-items: flex-start !important; margin-top: 8px !important; gap: 4px !important; }
            .dest-info button.btn, .dest-info a.btn { width: 100% !important; padding: 4px !important; font-size: 0.75rem !important; border-radius: 6px !important; }
            .dest-price .amount { font-size: 0.9rem !important; }
            
            /* Clean up previous classes that might be unused */
            .dest-content { padding: 12px !important; }
            .dest-content h3 { font-size: 0.95rem !important; margin-bottom: 5px !important; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
            .dest-content p { display: none; }
            .dest-footer { padding-top: 10px !important; flex-direction: column !important; align-items: flex-start !important; gap: 6px !important; }
            .dest-footer .btn { width: 100% !important; padding: 4px !important; font-size: 0.75rem !important; }
            .price-tag { font-size: 0.9rem !important; }
            .price-tag span { font-size: 0.65rem !important; }
            .type-badge { top: 5px !important; left: 5px !important; padding: 2px 6px !important; font-size: 0.55rem !important; }
            .pkg-badge { top: 5px !important; right: 5px !important; padding: 2px 6px !important; font-size: 0.55rem !important; }
            
            section { padding: 40px 0 !important; }
            .container { padding: 0 16px !important; }
            h2 { font-size: 1.5rem !important; }
            .section-header { margin-bottom: 24px !important; }
            .section-header h2 { font-size: 1.5rem !important; }
            .section-header p { font-size: 0.85rem !important; }
            
            .nav-actions { gap: 15px; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav id="navbar">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center; width: 100%; max-width: 100%;">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Travelingin.id Logo" style="max-height: 85px; width: auto;">
            </a>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ url('/destinations') }}">Destinations</a></li>
                <li><a href="{{ route('special-offers') }}">Special Offers</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
            <div class="nav-actions">
                @if (Route::has('login'))
                    @auth
                        <div style="position: relative; display: inline-block;">
                            <a href="#" class="login-link" onclick="document.getElementById('dropdown-menu').classList.toggle('show'); return false;" style="display: flex; align-items: center; gap: 12px;">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=D4AF37&color=fff&rounded=true" alt="Profile" style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid var(--accent);">
                                <span class="user-name" style="font-size: 0.9rem;">{{ Auth::user()->name }}</span>
                            </a>
                            <div id="dropdown-menu" class="dropdown-content">
                                @if(Auth::user()->is_admin)
                                    <a href="{{ route('admin.dashboard') }}" style="color: var(--accent); font-weight: 700;"><i class="fas fa-crown"></i> Admin Dashboard</a>
                                @endif
                                <a href="{{ route('profile.edit') }}"><i class="fas fa-user-edit"></i> Profile Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="login-link">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                        @endif
                    @endauth
                @endif
                <button class="mobile-toggle" id="mobile-toggle-btn" aria-label="Toggle Navigation">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Drawer & Backdrop -->
    <div class="mobile-drawer-backdrop" id="mobile-backdrop"></div>
    <div class="mobile-drawer" id="mobile-drawer">
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('about') }}">About Us</a>
        <a href="{{ url('/destinations') }}">Destinations</a>
        <a href="{{ route('special-offers') }}">Special Offers</a>
        <a href="#contact">Contact Us</a>
        @auth
            <a href="{{ route('profile.edit') }}" style="color: var(--accent);"><i class="fas fa-user-circle"></i> Profil Saya</a>
        @else
            <a href="{{ route('login') }}" style="color: var(--accent);"><i class="fas fa-sign-in-alt"></i> Login</a>
        @endauth
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="World" class="hero-bg">
        <div class="hero-overlay"></div>
        <div class="hero-content" data-aos="fade-up" data-aos-duration="1500">
            <h1>Travel Beyond Your Imagination</h1>
            <p>Curated luxury experiences for families and adventurous souls. Discover the world's most breathtaking destinations with Travelingin.id.</p>
            <div class="hero-btns">
                <a href="{{ url('/destinations') }}" class="btn btn-primary">Explore Destinations <i class="fas fa-arrow-right"></i></a>
                <a href="#" onclick="openTripFinderModal(); return false;" class="btn btn-outline" style="border: 2px solid var(--accent); color: var(--accent);"> <i class="fas fa-magic"></i> Try Trip Finder</a>
            </div>
        </div>
    </section>

    <!-- Trip Finder Banner -->
    <section style="background: var(--primary); padding: 60px 0; border-top: 1px solid rgba(255,255,255,0.05);">
        <div class="container" style="display: flex; align-items: center; justify-content: space-between; gap: 40px; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 300px;">
                <h3 style="color: var(--white); font-size: 1.8rem; margin-bottom: 10px;">Bingung Pilih Destinasi?</h3>
                <p style="color: rgba(255,255,255,0.6);">Gunakan sistem cerdas kami untuk menemukan trip yang paling sesuai dengan budget dan keinginan Anda.</p>
            </div>
            <a href="#" onclick="openTripFinderModal(); return false;" class="btn btn-primary" style="padding: 18px 40px;">
                Coba Trip Finder Sekarang <i class="fas fa-sparkles" style="margin-left: 10px;"></i>
            </a>
        </div>
    </section>

    <!-- Travel Category Section -->
    <section id="categories">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>Tailored Experiences</span>
                <h2>Choose Your Path</h2>
                <p>Whether you're seeking a serene family retreat or an adrenaline-fueled solo adventure, we have the perfect journey waiting for you.</p>
            </div>
            <div class="categories-grid">
                <!-- Family Trip -->
                <div class="category-card" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Family">
                    <div class="category-overlay">
                        <h3>Family</h3>
                        <p>Create lasting memories with curated premium comfort and family-friendly itineraries.</p>
                        <a href="{{ url('/destinations?package_type=family') }}" class="btn btn-outline">Explore Family Packages</a>
                    </div>
                </div>
                <!-- Backpacker Trip -->
                <div class="category-card" data-aos="fade-up">
                    <img src="https://images.unsplash.com/photo-1503220317375-aaad61436b1b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Backpacker">
                    <div class="category-overlay">
                        <h3>Backpacker</h3>
                        <p>For the bold and adventurous. Discover the world's hidden gems on a flexible budget.</p>
                        <a href="{{ url('/destinations?package_type=backpacker') }}" class="btn btn-outline">Explore Backpacker Routes</a>
                    </div>
                </div>
                <!-- General Trip -->
                <div class="category-card" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="General">
                    <div class="category-overlay">
                        <h3>General</h3>
                        <p>Ideal for everyone. Balanced itineraries offering the best of sight-seeing, culture, and relaxation.</p>
                        <a href="{{ url('/destinations?package_type=general') }}" class="btn btn-outline">Explore General Packages</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Destinations -->
    <section id="destinations" class="destinations-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>Featured Destinations</span>
                <h2>The World's Finest</h2>
                <p>Hand-picked locations that redefine the meaning of adventure and luxury.</p>
            </div>
            <div class="dest-grid">
                @foreach($destinations as $index => $dest)
                <div class="dest-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="dest-img-container">
                        @if($dest->image)
                            <img src="{{ Str::startsWith($dest->image, ['http://', 'https://']) ? $dest->image : asset('storage/' . $dest->image) }}" referrerpolicy="no-referrer" alt="{{ $dest->name }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1506012733851-bb9745564c73?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" referrerpolicy="no-referrer" alt="{{ $dest->name }}">
                        @endif
                        
                        <div class="dest-badge">
                            @if($dest->discount_price || $dest->is_special_offer)
                                PROMO
                            @elseif($dest->bookings_count > 0)
                                BEST SELLER
                            @else
                                RECOMMENDED
                            @endif
                        </div>
                    </div>
                    <div class="dest-info">
                        <h3>{{ $dest->name }}</h3>
                        <div class="dest-meta">
                            <span><i class="fas fa-users"></i> {{ $dest->quota > 0 ? $dest->quota . ' Slots Left' : 'Unlimited' }}</span>
                            <span><i class="fas fa-calendar-alt"></i> {{ $dest->travel_date ? \Carbon\Carbon::parse($dest->travel_date)->format('d M Y') : 'Contact Us' }}</span>
                        </div>
                        <div class="dest-price">
                            <span class="label">Starting at</span>
                            @if($dest->discount_price)
                                <span style="text-decoration: line-through; opacity: 0.5; font-size: 0.95rem; margin-right: 5px; color: var(--text-muted); font-weight: 500;">Rp {{ number_format($dest->price, 0, ',', '.') }}</span>
                                <span class="amount">Rp {{ number_format($dest->discount_price, 0, ',', '.') }}</span>
                            @else
                                <span class="amount">Rp {{ number_format($dest->price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <a href="{{ route('destinations.show', $dest->id) }}" class="btn btn-dark-outline" style="width: 100%; margin-top: auto;">View Details</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="features">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>Our Signature</span>
                <h2>Why Travel With Us?</h2>
            </div>
            <div class="features-grid">
                <div class="feature-item" data-aos="zoom-in" data-aos-delay="100">
                    <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                    <h4>Ultimate Safety</h4>
                    <p>Verified partners and 24/7 dedicated support for peace of mind.</p>
                </div>
                <div class="feature-item" data-aos="zoom-in" data-aos-delay="200">
                    <div class="feature-icon"><i class="fas fa-gem"></i></div>
                    <h4>Luxury Curation</h4>
                    <p>Only the finest accommodations and exclusive local experiences.</p>
                </div>
                <div class="feature-item" data-aos="zoom-in" data-aos-delay="300">
                    <div class="feature-icon"><i class="fas fa-wallet"></i></div>
                    <h4>Smart Payments</h4>
                    <p>Flexible installments and transparent pricing with no hidden fees.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>Traveler Stories</span>
                <h2>What They Say</h2>
            </div>
            <div class="testi-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                <div class="testi-card" data-aos="fade-up" data-aos-delay="100">
                    <p class="testi-text">"Travelingin.id made our family trip to Bali absolutely perfect. Everything was well-organized, and the kids loved it!"</p>
                    <div class="testi-user">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Sarah">
                        <div>
                            <h4>Sarah Jenkins</h4>
                            <span>Family Traveler</span>
                        </div>
                    </div>
                </div>
                <div class="testi-card" data-aos="fade-up" data-aos-delay="200">
                    <p class="testi-text">"The down payment system really helped me budget for my trip to Japan. I had an amazing time without any stress."</p>
                    <div class="testi-user">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Michael">
                        <div>
                            <h4>Michael Chen</h4>
                            <span>Solo Adventurer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container" data-aos="fade-up">
            <h2>Ready for Your Next Story?</h2>
            <p>Join thousands of travelers who have found their perfect escape with us. Your journey starts with a single click.</p>
            <a href="{{ route('register') }}" class="btn btn-primary">Start Your Adventure Today <i class="fas fa-paper-plane"></i></a>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="{{ url('/') }}" class="logo" style="display: block; margin-bottom: 30px;">
                        <img src="{{ asset('images/logo.png') }}" alt="Travelingin.id Logo" style="max-height: 110px; width: auto; filter: brightness(0) invert(1);">
                    </a>
                    <p style="color: rgba(255,255,255,0.6); margin-bottom: 30px;">Elevating travel experiences through curated luxury and authentic discovery. Your world, your way.</p>
                    <div class="social-links">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}">Our Story</a></li>
                        <li><a href="#">Our Vision</a></li>
                        <li><a href="{{ route('special-offers') }}">Special Offers</a></li>
                        <li><a href="#">Travel Blog</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Support</h4>
                    <ul class="footer-links">
                        <li><a href="#">Contact Help</a></li>
                        <li><a href="#">FAQ Center</a></li>
                        <li><a href="#">Booking Guide</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Reach Us</h4>
                    <ul class="footer-links" style="color: rgba(255,255,255,0.6);">
                        <li style="display: flex; gap: 15px;"><i class="fas fa-map-marker-alt" style="color: var(--accent); margin-top: 5px;"></i> Sudirman CBD, Jakarta, Indonesia</li>
                        <li style="display: flex; gap: 15px;"><i class="fas fa-phone" style="color: var(--accent); margin-top: 5px;"></i> +62 812 3456 7890</li>
                        <li style="display: flex; gap: 15px;"><i class="fas fa-envelope" style="color: var(--accent); margin-top: 5px;"></i> hello@travelingin.id</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 Travelingin.id. Crafted with passion for global explorers.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // Dropdown Toggle
        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('dropdown-menu');
            if (dropdown && !e.target.closest('.login-link')) {
                dropdown.classList.remove('show');
            }
        });

        // Mobile Drawer Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('mobile-toggle-btn');
            const drawer = document.getElementById('mobile-drawer');
            const backdrop = document.getElementById('mobile-backdrop');

            function toggleMobileMenu() {
                drawer.classList.toggle('open');
                backdrop.classList.toggle('open');
            }

            if (toggleBtn) toggleBtn.addEventListener('click', toggleMobileMenu);
            if (backdrop) backdrop.addEventListener('click', toggleMobileMenu);
        });
    </script>
    @include('components.booking-modal')
    @include('components.trip-finder-modal')
    <x-chat-widget />
</body>
</html>
