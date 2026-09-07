<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="format-detection" content="telephone=no">
    <title>Special Offers | Travelingin.id</title>
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
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --glass: rgba(255, 255, 255, 0.7);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { -webkit-text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; width: 100%; max-width: 100vw; overflow-x: hidden; }
        body { font-family: var(--font-body); color: var(--text-main); background-color: var(--bg-light); line-height: 1.7; width: 100%; max-width: 100vw; overflow-x: hidden; }
        h1, h2, h3, h4, h5, h6 { font-family: var(--font-heading); color: var(--primary); font-weight: 700; }
        a { text-decoration: none; color: inherit; transition: var(--transition); }
        ul { list-style: none; }
        .container { max-width: 1400px; margin: 0 auto; padding: 0 40px; }

        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 12px 28px; border-radius: 100px; font-weight: 600; cursor: pointer; transition: var(--transition); border: none; gap: 10px; font-size: 0.9rem; }
        .btn-primary { background: linear-gradient(135deg, var(--accent), #B8860B); color: var(--white); box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3); }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 12px 25px rgba(212, 175, 55, 0.4); }
        .btn-outline { background-color: transparent; border: 1px solid rgba(0,0,0,0.1); color: var(--primary); }
        .btn-outline:hover { background-color: var(--primary); color: var(--white); }

        /* Navbar */
        nav { position: fixed; top: 0; left: 0; width: 100%; padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; z-index: 1000; background: var(--glass); backdrop-filter: blur(15px); border-bottom: 1px solid rgba(0,0,0,0.05); }
        .logo img { max-height: 80px; width: auto; }
        .nav-links { display: flex; gap: 30px; }
        .nav-links a { color: var(--primary); font-weight: 500; font-size: 0.9rem; }
        .nav-links a:hover { color: var(--accent); }

        /* Header */
        .page-header { 
            padding: 180px 0 100px;
            background: linear-gradient(rgba(10, 25, 47, 0.8), rgba(10, 25, 47, 0.8)), url('https://images.unsplash.com/photo-1506012733851-bb9745564c73?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover;
            text-align: center;
            color: var(--white);
        }
        .page-header h1 { font-size: 4rem; color: var(--white); margin-bottom: 20px; }
        .page-header p { font-size: 1.2rem; opacity: 0.9; max-width: 700px; margin: 0 auto; }

        /* Offers Grid */
        .offers-grid { padding: 100px 0; display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 40px; }
        
        .offer-card { background: var(--white); border-radius: 30px; overflow: hidden; box-shadow: var(--shadow-lg); position: relative; transition: var(--transition); border: 1px solid rgba(0,0,0,0.05); }
        .offer-card:hover { transform: translateY(-10px); }
        
        .offer-img-wrap { height: 280px; position: relative; overflow: hidden; }
        .offer-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: var(--transition); }
        .offer-card:hover .offer-img-wrap img { transform: scale(1.1); }
        
        .discount-badge { position: absolute; top: 25px; left: 25px; background: #FF4757; color: var(--white); padding: 8px 20px; border-radius: 50px; font-weight: 800; font-size: 0.9rem; z-index: 10; box-shadow: 0 5px 15px rgba(255, 71, 87, 0.3); }
        .type-badge { position: absolute; top: 25px; right: 25px; background: rgba(255,255,255,0.9); color: var(--primary); padding: 8px 20px; border-radius: 50px; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; z-index: 10; }

        .offer-content { padding: 40px; }
        .offer-content h3 { font-size: 1.6rem; margin-bottom: 15px; }
        .offer-content p { color: var(--text-muted); font-size: 1rem; margin-bottom: 25px; }
        
        .price-row { display: flex; align-items: baseline; gap: 15px; margin-bottom: 30px; }
        .original-price { font-size: 1.1rem; color: var(--text-muted); text-decoration: line-through; }
        .discount-price { font-size: 2rem; font-weight: 800; color: #FF4757; }
        .price-unit { font-size: 0.9rem; color: var(--text-muted); font-weight: 400; }

        .offer-footer { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 25px; }
        .quota-info { font-size: 0.85rem; color: var(--text-muted); display: flex; align-items: center; gap: 8px; }
        .quota-info i { color: var(--accent); }

        /* Footer */
        footer { background: var(--primary); color: var(--white); padding: 100px 0 40px; }
        .footer-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr 1.2fr; gap: 60px; margin-bottom: 60px; }
        .footer-col h4 { color: var(--white); margin-bottom: 25px; text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; }
        .footer-links a { color: rgba(255,255,255,0.6); font-size: 0.9rem; transition: var(--transition); }
        .footer-links a:hover { color: var(--accent); padding-left: 8px; }

        /* Mobile Menu Styles */
        .mobile-toggle {
            display: none;
            background: transparent;
            border: none;
            color: var(--primary);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 8px;
            z-index: 1001;
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
            .offers-grid { grid-template-columns: 1fr; gap: 30px; }
        }

        @media (max-width: 768px) {
            nav { padding: 15px 5% !important; }
            .logo img { max-height: 40px !important; }
            .mobile-toggle { font-size: 1.8rem; padding: 4px; }
            .container { padding: 0 20px; }
            .page-header { padding: 100px 0 50px !important; }
            .page-header h1 { font-size: 2rem !important; line-height: 1.2; margin-bottom: 12px !important; }
            .page-header p { font-size: 0.95rem !important; }
            .offers-grid { padding: 50px 0 !important; gap: 24px; }
            .offer-card { border-radius: 20px !important; }
            .offer-img-wrap { height: 200px !important; }
            .offer-content { padding: 20px !important; }
            .offer-content h3 { font-size: 1.3rem !important; margin-bottom: 12px !important; }
            .offer-content p { font-size: 0.9rem !important; margin-bottom: 20px !important; }
            .discount-price { font-size: 1.6rem !important; }
            .btn { padding: 12px 20px !important; font-size: 0.9rem !important; }
            .footer-grid { grid-template-columns: 1fr; gap: 30px; }
            .nav-actions { gap: 15px; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <div class="container" style="display: flex; justify-content: space-between; align-items: center; width: 100%; max-width: 100%;">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Travelingin.id Logo">
            </a>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ url('/destinations') }}">Destinations</a></li>
                <li><a href="{{ route('special-offers') }}" style="color: var(--accent);">Special Offers</a></li>
                <li><a href="{{ url('/#contact') }}">Contact Us</a></li>
            </ul>
            <div class="nav-actions" style="display: flex; align-items: center; gap: 15px;">
                @auth
                    <a href="{{ route('profile.edit') }}">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=D4AF37&color=fff&rounded=true" alt="Profile" style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid var(--accent);">
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary" style="padding: 10px 24px;">Login</a>
                @endauth
                <button class="mobile-toggle" id="mobile-toggle-btn" aria-label="Toggle Navigation">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Navigation Drawer -->
    <div class="mobile-drawer-backdrop" id="mobile-backdrop"></div>
    <div class="mobile-drawer" id="mobile-drawer">
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('about') }}">About Us</a>
        <a href="{{ url('/destinations') }}">Destinations</a>
        <a href="{{ route('special-offers') }}" style="color: var(--accent);">Special Offers</a>
        <a href="{{ url('/#contact') }}">Contact Us</a>
        @auth
            <a href="{{ route('profile.edit') }}" style="color: var(--accent);"><i class="fas fa-user-circle"></i> Profil Saya</a>
        @else
            <a href="{{ route('login') }}" style="color: var(--accent);"><i class="fas fa-sign-in-alt"></i> Login</a>
        @endauth
    </div>

    <!-- Header -->
    <header class="page-header">
        <div class="container" data-aos="fade-up">
            <h1>Special Offers</h1>
            <p>Exclusive deals on our most sought-after destinations. Limited time packages, tickets, and professional guide services at unbeatable prices.</p>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        @if($offers->isEmpty())
            <div style="text-align: center; padding: 150px 0;">
                <i class="fas fa-percent" style="font-size: 5rem; color: var(--bg-gray); margin-bottom: 30px;"></i>
                <h2>No Active Discounts Currently</h2>
                <p style="color: var(--text-muted); margin-top: 15px;">Check back soon for our next wave of exclusive offers.</p>
                <a href="{{ url('/destinations') }}" class="btn btn-primary" style="margin-top: 30px;">View Regular Destinations</a>
            </div>
        @else
            <div class="offers-grid">
                @foreach($offers as $offer)
                <div class="offer-card" data-aos="fade-up">
                    <div class="offer-img-wrap">
                        @php
                            $discount = 0;
                            if($offer->discount_price > 0 && $offer->price > 0) {
                                $discount = round((($offer->price - $offer->discount_price) / $offer->price) * 100);
                            }
                        @endphp
                        @if($discount > 0)
                            <div class="discount-badge">{{ $discount }}% OFF</div>
                        @else
                            <div class="discount-badge">LIMITED DEAL</div>
                        @endif
                        <div class="type-badge">{{ $offer->type }}</div>
                        
                        @if($offer->image)
                            <img src="{{ Str::startsWith($offer->image, ['http://', 'https://']) ? $offer->image : asset('storage/' . $offer->image) }}" referrerpolicy="no-referrer" alt="{{ $offer->name }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" referrerpolicy="no-referrer" alt="Special Offer">
                        @endif
                    </div>
                    
                    <div class="offer-content">
                        <h3><a href="{{ route('destinations.show', $offer->id) }}" style="color: inherit; text-decoration: none;" class="hover:text-accent">{{ $offer->name }}</a></h3>
                        <p>{{ Str::limit($offer->description, 120) }}</p>
                        
                        <div class="price-row">
                            @if($offer->discount_price)
                                <span class="original-price">Rp {{ number_format($offer->price, 0, ',', '.') }}</span>
                                <span class="discount-price">Rp {{ number_format($offer->discount_price, 0, ',', '.') }}</span>
                            @else
                                <span class="discount-price">Rp {{ number_format($offer->price, 0, ',', '.') }}</span>
                            @endif
                            <span class="price-unit">/ person</span>
                        </div>
                        
                        <div class="offer-footer">
                            <div class="quota-info" style="display: flex; flex-direction: column; gap: 5px;">
                                <span><i class="fas fa-users"></i> {{ $offer->quota > 0 ? 'Only ' . $offer->quota . ' slots left' : 'Unlimited slots' }}</span>
                                <span><i class="fas fa-calendar-alt"></i> {{ $offer->travel_date ? \Carbon\Carbon::parse($offer->travel_date)->format('d M Y') : 'Contact Us' }}</span>
                            </div>
                            <div style="display: flex; gap: 10px;">
                                <button type="button" onclick="openBookingModal('{{ $offer->id }}', '{{ addslashes($offer->name) }}', '{{ $offer->travel_date }}', {{ $offer->discount_price ?? $offer->price }}, '{{ $offer->type }}')" class="btn btn-primary" style="padding: 12px 30px; min-width: 120px;">Pesan</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="filter: brightness(0) invert(1); max-height: 80px;">
                    </a>
                    <p style="color: rgba(255,255,255,0.5); font-size: 0.95rem; margin-top: 30px;">Redefining the art of discovery with curated luxury and authentic local immersion.</p>
                </div>
                <div class="footer-col">
                    <h4>Exploration</h4>
                    <ul class="footer-links">
                        <li><a href="{{ url('/destinations') }}">New Destinations</a></li>
                        <li><a href="{{ route('special-offers') }}">Special Offers</a></li>
                        <li><a href="#">Cultural Heritage</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}">Our Story</a></li>
                        <li><a href="#">Privacy Ethics</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Reach Us</h4>
                    <div style="color: rgba(255,255,255,0.5); font-size: 0.9rem;">
                        <p style="margin-bottom: 15px;"><i class="fas fa-map-marker-alt" style="color: var(--accent); margin-right: 12px;"></i> Sudirman CBD, Jakarta</p>
                        <p><i class="fas fa-envelope" style="color: var(--accent); margin-right: 12px;"></i> hello@travelingin.id</p>
                    </div>
                </div>
            </div>
            <div style="text-align: center; color: rgba(255,255,255,0.3); padding-top: 40px; border-top: 1px solid rgba(255,255,255,0.05); font-size: 0.85rem;">
                <p>&copy; 2026 Travelingin.id. Elevating global exploration.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true, offset: 50 });

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
</body>
</html>
