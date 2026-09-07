<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="format-detection" content="telephone=no">
    <title>Curated Destinations | Travelingin.id</title>
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
        .logo img { max-height: 85px; width: auto; }
        .nav-links { display: flex; gap: 30px; }
        .nav-links a { color: var(--primary); font-weight: 500; font-size: 0.9rem; }
        .nav-links a:hover { color: var(--accent); }

        /* Header */
        .page-header { 
            padding: 200px 0 100px;
            background: linear-gradient(rgba(10, 25, 47, 0.8), rgba(10, 25, 47, 0.8)), url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            text-align: center;
            color: var(--white);
        }
        .page-header h1 { font-size: 3.5rem; margin-bottom: 15px; color: var(--white); }
        .page-header p { color: rgba(255,255,255,0.8); font-size: 1.1rem; max-width: 600px; margin: 0 auto; }

        /* Main Layout */
        .main-layout { display: grid; grid-template-columns: 320px 1fr; gap: 50px; padding: 80px 0; }

        /* Sidebar */
        .sidebar { position: sticky; top: 120px; height: fit-content; }
        .filter-card { background: var(--white); padding: 35px; border-radius: 25px; box-shadow: var(--shadow-lg); border: 1px solid rgba(0,0,0,0.03); }
        .filter-section { margin-bottom: 35px; }
        .filter-section h3 { font-size: 1rem; margin-bottom: 20px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; color: var(--primary); }
        .filter-links { display: flex; flex-direction: column; gap: 10px; }
        .filter-link { display: flex; align-items: center; gap: 15px; padding: 14px 20px; border-radius: 15px; color: var(--text-muted); font-weight: 600; font-size: 0.9rem; }
        .filter-link:hover { background: var(--bg-gray); color: var(--primary); }
        .filter-link.active { background: var(--primary); color: var(--white); }
        .filter-link i { width: 20px; color: var(--accent); }
        .filter-link.active i { color: var(--accent-light); }

        /* Booking Widget */
        .booking-widget { background: var(--primary); color: var(--white); padding: 35px; border-radius: 25px; margin-top: 30px; box-shadow: var(--shadow-lg); }
        .booking-widget h4 { color: var(--white); margin-bottom: 20px; font-size: 1.2rem; }
        .form-control { width: 100%; padding: 14px 18px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1); margin-bottom: 15px; background: rgba(255,255,255,0.05); color: var(--white); font-family: var(--font-body); font-size: 0.9rem; }
        .form-control::placeholder { color: rgba(255,255,255,0.4); }
        .form-control:focus { outline: none; border-color: var(--accent); background: rgba(255,255,255,0.1); }

        /* Product Grid */
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 35px; }
        .dest-card { background: var(--white); border-radius: 30px; overflow: hidden; box-shadow: var(--shadow-lg); border: 1px solid rgba(0,0,0,0.03); display: flex; flex-direction: column; height: 100%; transition: var(--transition); }
        .dest-card:hover { transform: translateY(-10px); }
        .dest-img-wrap { position: relative; height: 260px; overflow: hidden; }
        .dest-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 1s cubic-bezier(0.4, 0, 0.2, 1); }
        .dest-card:hover .dest-img-wrap img { transform: scale(1.1); }
        
        .type-badge { position: absolute; top: 25px; left: 25px; padding: 8px 18px; border-radius: 50px; background: var(--accent); color: var(--white); font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; z-index: 2; box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3); }
        .pkg-badge { position: absolute; top: 25px; right: 25px; padding: 8px 18px; border-radius: 50px; background: rgba(10, 25, 47, 0.85); color: var(--white); font-weight: 600; font-size: 0.75rem; z-index: 2; backdrop-filter: blur(5px); }

        .dest-content { padding: 35px; flex-grow: 1; display: flex; flex-direction: column; }
        .dest-content h3 { font-size: 1.5rem; margin-bottom: 15px; line-height: 1.3; }
        .dest-content p { color: var(--text-muted); font-size: 0.95rem; margin-bottom: 25px; line-height: 1.7; }
        .dest-meta { margin-bottom: 25px; display: flex; gap: 20px; font-size: 0.85rem; color: var(--text-muted); }
        .dest-meta i { color: var(--accent); }

        .dest-footer { margin-top: auto; display: flex; justify-content: space-between; align-items: center; padding-top: 30px; border-top: 1px solid rgba(0,0,0,0.05); }
        .price-tag { font-size: 1.4rem; font-weight: 800; color: var(--primary); }
        .price-tag span { font-size: 0.9rem; color: var(--text-muted); font-weight: 400; }

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

        @media (max-width: 1200px) {
            .main-layout { grid-template-columns: 1fr; }
            .sidebar { position: static; }
            .filter-card { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; }
        }
        @media (max-width: 992px) {
            .nav-links { display: none !important; }
            .mobile-toggle { display: block !important; }
            .nav-actions > *:not(.mobile-toggle) { display: none !important; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 768px) {
            nav { padding: 15px 5% !important; }
            .logo img { max-height: 40px !important; }
            .mobile-toggle { font-size: 1.8rem; padding: 4px; }
            .container { padding: 0 16px; }
            .main-layout { padding: 30px 0 !important; gap: 24px !important; }
            .filter-card { grid-template-columns: 1fr; padding: 15px !important; border-radius: 15px !important; }
            .page-header { padding: 80px 0 40px !important; }
            .page-header h1 { font-size: 1.8rem !important; line-height: 1.2; margin-bottom: 10px !important; }
            .page-header p { font-size: 0.9rem !important; }
            
            /* 2 Columns on Mobile */
            .product-grid { grid-template-columns: 1fr 1fr !important; gap: 12px !important; }
            
            .dest-card { border-radius: 12px !important; }
            .dest-img-wrap { height: 120px !important; }
            .dest-content { padding: 12px !important; }
            .dest-content h3 { font-size: 0.95rem !important; margin-bottom: 5px !important; line-height: 1.2; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
            .dest-content p { display: none; }
            .dest-meta { flex-direction: column !important; align-items: flex-start !important; gap: 4px !important; font-size: 0.7rem !important; margin-bottom: 8px !important; }
            .dest-footer { padding-top: 10px !important; flex-direction: column !important; align-items: flex-start !important; gap: 6px !important; }
            .dest-footer .btn { width: 100% !important; padding: 4px !important; min-width: 100% !important; font-size: 0.75rem !important; border-radius: 6px !important; }
            .price-tag { font-size: 0.9rem !important; }
            .price-tag span { font-size: 0.65rem !important; }
            .type-badge { top: 5px !important; left: 5px !important; padding: 2px 6px !important; font-size: 0.55rem !important; }
            .pkg-badge { top: 5px !important; right: 5px !important; padding: 2px 6px !important; font-size: 0.55rem !important; }
            
            .btn { padding: 10px 16px !important; font-size: 0.85rem !important; }
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
                <li><a href="{{ url('/destinations') }}" style="color: var(--accent);">Destinations</a></li>
                <li><a href="{{ route('special-offers') }}">Special Offers</a></li>
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
        <a href="{{ url('/destinations') }}" style="color: var(--accent);">Destinations</a>
        <a href="{{ route('special-offers') }}">Special Offers</a>
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
            <h1>Curated Collections</h1>
            <p>From architectural marvels to hidden natural wonders, discover the journey that speaks to your soul.</p>
        </div>
    </header>

    <div class="container">
        <div class="main-layout">
            <!-- Sidebar -->
            <aside class="sidebar" data-aos="fade-right">
                <div class="filter-card">
                    <div class="filter-section">
                        <h3>Categories</h3>
                        <div class="filter-links">
                            <a href="{{ url('/destinations') }}" class="filter-link {{ !request('type') ? 'active' : '' }}"><i class="fas fa-globe"></i> All Experiences</a>
                            <a href="{{ url('/destinations?type=tiket') }}" class="filter-link {{ request('type') == 'tiket' ? 'active' : '' }}"><i class="fas fa-ticket-alt"></i> Entry Tickets</a>
                            <a href="{{ url('/destinations?type=paket') }}" class="filter-link {{ request('type') == 'paket' ? 'active' : '' }}"><i class="fas fa-box"></i> Curated Packages</a>
                            <a href="{{ url('/destinations?type=tourguide') }}" class="filter-link {{ request('type') == 'tourguide' ? 'active' : '' }}"><i class="fas fa-user-tie"></i> Private Guides</a>
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3>Style</h3>
                        <div class="filter-links">
                            <a href="{{ url('/destinations?package_type=family' . (request('type') ? '&type='.request('type') : '')) }}" class="filter-link {{ request('package_type') == 'family' ? 'active' : '' }}"><i class="fas fa-users"></i> Family</a>
                            <a href="{{ url('/destinations?package_type=backpacker' . (request('type') ? '&type='.request('type') : '')) }}" class="filter-link {{ request('package_type') == 'backpacker' ? 'active' : '' }}"><i class="fas fa-hiking"></i> Backpacker</a>
                            <a href="{{ url('/destinations?package_type=general' . (request('type') ? '&type='.request('type') : '')) }}" class="filter-link {{ request('package_type') == 'general' ? 'active' : '' }}"><i class="fas fa-user-friends"></i> General</a>
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3>Urutkan Harga</h3>
                        <div class="filter-links">
                            <a href="{{ route('destinations.index', array_merge(request()->query(), ['sort' => 'price_asc'])) }}" class="filter-link {{ request('sort') == 'price_asc' ? 'active' : '' }}"><i class="fas fa-sort-amount-down-alt"></i> Termurah ke Termahal</a>
                            <a href="{{ route('destinations.index', array_merge(request()->query(), ['sort' => 'price_desc'])) }}" class="filter-link {{ request('sort') == 'price_desc' ? 'active' : '' }}"><i class="fas fa-sort-amount-up"></i> Termahal ke Termurah</a>
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3>Pilihan Khusus</h3>
                        <div class="filter-links">
                            <a href="{{ route('destinations.index', array_merge(request()->query(), ['promo' => request('promo') ? null : 1])) }}" class="filter-link {{ request('promo') ? 'active' : '' }}"><i class="fas fa-percentage"></i> Sedang Promo</a>
                            <a href="{{ route('destinations.index', array_merge(request()->query(), ['best_seller' => request('best_seller') ? null : 1])) }}" class="filter-link {{ request('best_seller') ? 'active' : '' }}"><i class="fas fa-fire"></i> Best Seller</a>
                        </div>
                    </div>

                    @if(request()->anyFilled(['type', 'package_type', 'sort', 'promo', 'best_seller']))
                        <div style="margin-top: 25px; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 20px;">
                            <a href="{{ route('destinations.index') }}" class="filter-link" style="color: var(--accent); justify-content: center; background: rgba(212,175,55,0.08); border-radius: 15px; font-weight: 700;"><i class="fas fa-undo"></i> Reset Semua Filter</a>
                        </div>
                    @endif
                </div>

                <div class="booking-widget" style="background: linear-gradient(135deg, var(--primary), var(--primary-light)); border: 1px solid rgba(212,175,55,0.2);">
                    <div style="width: 50px; height: 50px; background: rgba(212, 175, 55, 0.1); color: var(--accent); border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 20px;">
                        <i class="fas fa-magic"></i>
                    </div>
                    <h4 style="font-family: var(--font-heading); font-size: 1.4rem; color: var(--white); margin-bottom: 10px;">Cari Trip Sesuai Preferensi?</h4>
                    <p style="font-size: 0.85rem; opacity: 0.7; margin-bottom: 25px; line-height: 1.6;">Gunakan fitur Trip Finder kami untuk mencocokkan anggaran dan tipe perjalanan yang Anda cari secara instan.</p>
                    <button type="button" onclick="openTripFinderModal()" class="btn btn-primary" style="width: 100%; padding: 15px 25px; border-radius: 15px;">Coba Trip Finder <i class="fas fa-sparkles ml-1"></i></button>
                </div>
            </aside>

            <!-- Results -->
            <main>
                <div class="results-header" style="margin-bottom: 40px; display: flex; justify-content: space-between; align-items: baseline;">
                    <h2 style="font-size: 2rem;">
                        @if(request('type') == 'tiket') Iconic Tickets
                        @elseif(request('type') == 'paket') Signature Packages
                        @elseif(request('type') == 'tourguide') Professional Guides
                        @else Exploring All
                        @endif
                    </h2>
                    <span style="color: var(--text-muted); font-weight: 500;">{{ $destinations->count() }} Results Found</span>
                </div>

                @if($destinations->isEmpty())
                    <div style="text-align: center; padding: 120px 40px; background: var(--bg-gray); border-radius: 40px;">
                        <i class="fas fa-compass" style="font-size: 4rem; color: var(--accent); margin-bottom: 30px; opacity: 0.2;"></i>
                        <h3>No matches found</h3>
                        <p style="color: var(--text-muted);">Try broadening your search criteria or explore our other collections.</p>
                        <a href="{{ url('/destinations') }}" class="btn btn-primary" style="margin-top: 30px;">Show All Destinations</a>
                    </div>
                @else
                    <div class="product-grid">
                        @foreach($destinations as $dest)
                        <div class="dest-card" data-aos="fade-up">
                            <div class="dest-img-wrap">
                                <span class="type-badge">{{ $dest->type }}</span>
                                @if($dest->package_type && $dest->package_type != 'general')
                                    <span class="pkg-badge">{{ ucfirst($dest->package_type) }}</span>
                                @endif
                                
                                @if($dest->image)
                                    <img src="{{ Str::startsWith($dest->image, ['http://', 'https://']) ? $dest->image : asset('storage/' . $dest->image) }}" referrerpolicy="no-referrer" alt="{{ $dest->name }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" referrerpolicy="no-referrer" alt="Destination">
                                @endif

                                @if($dest->discount_price)
                                    <span class="promo-badge" style="position: absolute; bottom: 20px; left: 25px; padding: 6px 14px; border-radius: 8px; background: #EF4444; color: white; font-weight: 800; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.5px; z-index: 2; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3); font-family: var(--font-body);">PROMO</span>
                                @endif
                                @if($dest->bookings_count > 0 || $dest->loyalty_points >= 100)
                                    <span class="bestseller-badge" style="position: absolute; bottom: 20px; right: 25px; padding: 6px 14px; border-radius: 8px; background: #3B82F6; color: white; font-weight: 800; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.5px; z-index: 2; box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3); font-family: var(--font-body);">BEST SELLER</span>
                                @endif
                            </div>
                            <div class="dest-content">
                                <h3><a href="{{ route('destinations.show', $dest->id) }}" style="color: inherit; text-decoration: none;" class="hover:text-accent">{{ $dest->name }}</a></h3>
                                <p>{{ Str::limit($dest->description, 100) }}</p>
                                
                                <div class="dest-meta">
                                    <span><i class="fas fa-users"></i> {{ $dest->quota > 0 ? $dest->quota . ' slots left' : 'Unlimited' }}</span>
                                    <span><i class="fas fa-calendar-alt"></i> {{ $dest->travel_date ? \Carbon\Carbon::parse($dest->travel_date)->format('d M Y') : 'Contact Us' }}</span>
                                </div>

                                <div class="dest-footer">
                                    <div class="price-tag">
                                        @if($dest->discount_price)
                                            <span style="font-size: 0.8rem; text-decoration: line-through; color: var(--text-muted); display: block; font-weight: 400;">Rp {{ number_format($dest->price, 0, ',', '.') }}</span>
                                            Rp {{ number_format($dest->discount_price, 0, ',', '.') }}
                                        @else
                                            Rp {{ number_format($dest->price, 0, ',', '.') }}
                                        @endif
                                        <span>/ pax</span>
                                    </div>
                                    <div style="display: flex; gap: 10px;">
                                        <button type="button" onclick="openBookingModal('{{ $dest->id }}', '{{ addslashes($dest->name) }}', '{{ $dest->travel_date }}', {{ $dest->discount_price ?? $dest->price }}, '{{ $dest->type }}')" class="btn btn-primary" style="padding: 12px 30px; min-width: 120px;">Pesan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </main>
        </div>
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
                        <li><a href="{{ url('/#contact') }}">Contact Us</a></li>
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
    @include('components.trip-finder-modal')
</body>
</html>