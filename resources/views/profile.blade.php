<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: #f5f5f5;
        }

        /* Header */
        .header {
            background: #222;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
        }

        /* Banner */
        .banner {
            background: url('https://images.unsplash.com/photo-1561484930-998b6a7b22e8') center/cover;
            height: 220px;
            position: relative;
        }

        .banner-text {
            color: white;
            text-align: center;
            padding-top: 80px;
            font-size: 24px;
            font-weight: bold;
        }

        /* Wrapper */
        .profile-wrapper {
            position: relative;
            margin-top: -80px;
        }

        /* Card */
        .card {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
        }

        /* Profile top */
        .top {
            display: flex;
            align-items: center;
        }

        .avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            margin-right: 20px;
            border: 5px solid white;
        }

        h2 {
            margin: 0;
        }

        /* Tabs */
        .tabs {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }

        .tab {
            padding: 10px 18px;
            background: #eee;
            cursor: pointer;
            border-radius: 5px;
        }

        .tab.active {
            background: #007bff;
            color: white;
        }

        /* Content */
        .content {
            margin-top: 25px;
        }

        .hidden {
            display: none;
        }

        /* Logout */
        .logout {
            float: right;
        }

        .logout button {
            background: red;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
        }

        .logout button:hover {
            background: darkred;
        }

    </style>

    <script>
        function showTab(event, tab) {
            document.getElementById('bookings').classList.add('hidden');
            document.getElementById('settings').classList.add('hidden');

            document.getElementById(tab).classList.remove('hidden');

            let tabs = document.getElementsByClassName('tab');
            for (let i = 0; i < tabs.length; i++) {
                tabs[i].classList.remove('active');
            }

            event.target.classList.add('active');
        }
    </script>
</head>
<body>

<!-- Header -->
<div class="header">
    <div><strong>TravelBooking</strong></div>
    <div>Hi, {{ session('user')->name }}</div>
</div>

<!-- Banner -->
<div class="banner">
    <div class="banner-text">Explore Malaysia 🇲🇾</div>
</div>

<!-- Profile Wrapper -->
<div class="profile-wrapper">

    <div class="card">

        @if(session('success'))
            <div style="padding: 12px 16px; background: #e6ffed; color: #0f5132; border: 1px solid #c3e6cb; border-radius: 8px; margin-bottom: 16px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Logout -->
        <div class="logout">
            <form action="/logout" method="POST">
                @csrf
                <button>Logout</button>
            </form>
        </div>

        <!-- Profile Info -->
        <div class="top">
            <img src="/images/default-avatar.png" class="avatar">

            <div>
                <h2>{{ session('user')->name }}</h2>
                <p>{{ session('user')->email }}</p>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
            <div class="tab active" onclick="showTab(event, 'bookings')">My Bookings</div>
            <div class="tab" onclick="showTab(event, 'settings')">Account Settings</div>
        </div>

        <!-- Content -->
        <div class="content">

            <!-- BOOKINGS -->
            <div id="bookings">
                <h3>My Bookings</h3>
                <p style="color: gray;">No bookings yet.</p>
            </div>

            <!-- SETTINGS -->
            <div id="settings" class="hidden">
                <h3>Update Profile</h3>

                <form method="POST" action="/update-profile">
                    @csrf

                    <input type="text" name="name" value="{{ session('user')->name }}">
                    <br><br>

                    <input type="email" name="email" value="{{ session('user')->email }}">
                    <br><br>

                    <button style="background:green;color:white;">Update</button>
                </form>
            </div>

        </div>

    </div>

</div>

</body>
</html>