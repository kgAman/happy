@extends('layouts.master')

@section('title', 'Chat | HappilyWeds')

@push('page-styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,600&family=Poppins:wght@300;400;500;600;700&display=swap');

    :root {
        --brand-pink: #e75480;
        --brand-pink-light: #fdf2f5;
        --brand-pink-hover: #d6406c;
        --chat-bg: #f5f2f3; 
        --msg-received: #ffffff;
        --msg-sent: #e75480;
        --text-dark: #2d1b2e;
        --text-muted: #8e8e93;
        --border-color: #f0e6ea;
        --hover-bg: #f8f9fa;
    }

    body {
        background-color: #f4f7f6; /* Outer page background */
        font-family: 'Poppins', sans-serif;
        position: relative;
        overflow-x: hidden;
    }

    footer, .site-footer, #footer {
        display: none !important;
    }

    .chat-page-wrapper {
        padding-top: 100px; /* Clears your fixed navbar */
        padding-bottom: 30px;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 10;
    }

    /* --- EXPANDED 3-PANE CONTAINER --- */
    .chat-container {
        width: 100%;
        max-width: 1400px; 
        background: #ffffff;
        border-radius: 30px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05); /* Softer shadow since the gradient is gone */
        overflow: hidden;
        height: calc(100vh - 130px); 
        min-height: 600px;
        border: 1px solid var(--border-color);
    }

    /* ================= LEFT PANE: CHAT LIST ================= */
    .chat-sidebar {
        background: #ffffff;
        border-right: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .sidebar-header {
        padding: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .sidebar-header h3 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
        font-family: 'Playfair Display', serif;
        color: var(--text-dark);
    }

    .chat-search {
        padding: 0 25px 20px 25px;
    }

    .chat-search-input {
        background: var(--hover-bg);
        border: 1px solid transparent;
        border-radius: 50px;
        padding: 12px 20px 12px 40px;
        width: 100%;
        font-size: 0.9rem;
        outline: none;
        transition: all 0.3s;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%238e8e93' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: 15px center;
    }

    .chat-search-input:focus {
        background-color: #ffffff;
        border-color: var(--brand-pink);
        box-shadow: 0 0 0 4px var(--brand-pink-light);
    }

    .chat-list {
        flex: 1;
        overflow-y: auto;
    }

    .chat-list::-webkit-scrollbar, .chat-body::-webkit-scrollbar, .profile-sidebar::-webkit-scrollbar { width: 5px; }
    .chat-list::-webkit-scrollbar-thumb, .chat-body::-webkit-scrollbar-thumb, .profile-sidebar::-webkit-scrollbar-thumb { background-color: #e2e8f0; border-radius: 10px; }

    .chat-list-item {
        display: flex;
        align-items: center;
        padding: 15px 25px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        color: inherit;
        border-left: 4px solid transparent;
        border-bottom: 1px solid #f8f9fa;
    }

    .chat-list-item:hover { background-color: var(--hover-bg); }
    .chat-list-item.active {
        background-color: var(--brand-pink-light);
        border-left: 4px solid var(--brand-pink);
    }

    .chat-list-avatar {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
    }

    .chat-list-info { flex: 1; min-width: 0; }
    
    .chat-list-name-time {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 4px;
    }

    .chat-list-name {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--text-dark);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .chat-list-time { font-size: 0.75rem; color: var(--text-muted); white-space: nowrap; }
    .chat-list-preview { display: flex; justify-content: space-between; align-items: center; }
    .chat-list-message {
        margin: 0;
        font-size: 0.85rem;
        color: var(--text-muted);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding-right: 10px;
    }

    .unread-badge {
        background-color: var(--brand-pink);
        color: white;
        font-size: 0.7rem;
        font-weight: 700;
        min-width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50px;
        padding: 0 6px;
    }

    /* ================= CENTER PANE: MAIN CHAT ================= */
    .chat-main {
        display: flex;
        flex-direction: column;
        height: 100%;
        background-color: var(--chat-bg);
        position: relative;
    }

    .chat-header {
        padding: 20px 30px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 10;
        min-height: 90px;
    }

    .chat-user-info { display: flex; align-items: center; gap: 15px; text-decoration: none; }
    .chat-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }
    .chat-user-details h4 { margin: 0; font-size: 1.2rem; font-weight: 600; color: var(--text-dark); }
    .chat-status { font-size: 0.85rem; color: var(--text-muted); display: flex; align-items: center; gap: 6px; }
    .status-dot { width: 8px; height: 8px; background-color: #10b981; border-radius: 50%; box-shadow: 0 0 0 2px rgba(16,185,129,0.2); }

    .chat-header-actions .btn-icon {
        background: none;
        border: none;
        color: var(--brand-pink);
        font-size: 1.3rem;
        padding: 8px;
        border-radius: 50%;
        transition: background 0.2s;
    }
    .chat-header-actions .btn-icon:hover { background: var(--brand-pink-light); }

    /* WhatsApp Style Random Hearts Background for Chat Body */
    .chat-body {
        flex: 1;
        padding: 30px;
        background-color: var(--chat-bg);
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='120' viewBox='0 0 100 100'%3E%3Cg fill='%23e75480' fill-opacity='0.08'%3E%3Cpath d='M25 35c-4-4-10-4-10 1 0 4 10 11 10 11s10-7 10-11c0-5-6-5-10-1z'/%3E%3Cpath d='M75 85c-3-3-8-3-8 1 0 3 8 8 8 8s8-5 8-8c0-4-5-4-8-1z' transform='rotate(-15 75 85)'/%3E%3Cpath d='M80 20c-2-2-6-2-6 1 0 2 6 6 6 6s6-4 6-6c0-3-4-3-6-1z' transform='rotate(20 80 20)'/%3E%3Cpath d='M20 80c-2-2-5-2-5 0.5 0 1.5 5 4.5 5 4.5s5-3 5-4.5c0-2.5-3-2.5-5-0.5z' transform='rotate(40 20 80)'/%3E%3Ccircle cx='15' cy='75' r='2'/%3E%3Ccircle cx='45' cy='15' r='1.5'/%3E%3Ccircle cx='90' cy='50' r='2.5'/%3E%3Ccircle cx='50' cy='60' r='1.5'/%3E%3Ccircle cx='30' cy='95' r='1'/%3E%3Ccircle cx='60' cy='35' r='2'/%3E%3C/g%3E%3C/svg%3E");
        background-repeat: repeat;
        background-size: 150px 150px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .empty-chat {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: var(--text-muted);
        text-align: center;
    }
    
    .empty-chat-img {
        width: 120px;
        height: 120px;
        background: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        color: var(--brand-pink);
        font-size: 3.5rem;
        box-shadow: 0 10px 30px rgba(231,84,128,0.1);
    }

    .message { display: flex; flex-direction: column; max-width: 75%; }
    .message-received { align-self: flex-start; }
    .message-sent { align-self: flex-end; }

    .message-bubble {
        padding: 12px 16px;
        font-size: 0.95rem;
        line-height: 1.5;
        position: relative;
    }

    .message-received .message-bubble {
        background-color: var(--msg-received);
        color: var(--text-dark);
        border-radius: 20px 20px 20px 5px;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }

    .message-sent .message-bubble {
        background-color: var(--msg-sent);
        color: #ffffff;
        border-radius: 20px 20px 5px 20px;
        box-shadow: 0 4px 10px rgba(231, 84, 128, 0.25);
    }

    .message-time { font-size: 0.7rem; color: var(--text-muted); margin-top: 6px; font-weight: 500; }
    .message-sent .message-time { text-align: right; }

    /* Input Footer */
    .chat-footer {
        padding: 20px 30px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-top: 1px solid var(--border-color);
        z-index: 10;
    }

    .chat-input-wrapper {
        display: flex;
        align-items: flex-end;
        background: #ffffff;
        border-radius: 30px;
        padding: 8px 15px;
        border: 1px solid var(--border-color);
        box-shadow: 0 5px 20px rgba(0,0,0,0.03);
        transition: all 0.3s;
    }

    .chat-input-wrapper:focus-within {
        border-color: var(--brand-pink);
        box-shadow: 0 5px 20px rgba(231, 84, 128, 0.15);
    }

    .btn-attach {
        background: none;
        border: none;
        color: var(--text-muted);
        font-size: 1.4rem;
        padding: 10px;
        border-radius: 50%;
        transition: color 0.2s;
    }

    .btn-attach:hover { color: var(--brand-pink); }

    .chat-input {
        flex: 1;
        border: none;
        background: none;
        padding: 14px 15px;
        font-size: 1rem;
        color: var(--text-dark);
        resize: none;
        outline: none;
        max-height: 120px;
        font-family: inherit;
    }

    .chat-input::placeholder { color: #a0a0a0; }

    .btn-send {
        background: var(--brand-pink);
        color: white;
        border: none;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-bottom: 2px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(231, 84, 128, 0.3);
    }

    .btn-send:hover { transform: scale(1.05) rotate(5deg); }
    .btn-send i { font-size: 1.2rem; margin-left: -2px; }

    /* ================= RIGHT PANE: PROFILE SNAPSHOT ================= */
    .profile-sidebar {
        background: #ffffff;
        border-left: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
        height: 100%;
        padding: 40px 30px;
        overflow-y: auto;
        align-items: center;
    }

    .snapshot-img-wrapper {
        position: relative;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        padding: 6px;
        background: linear-gradient(135deg, var(--brand-pink) 0%, #ff7eb3 100%);
        margin-bottom: 20px;
    }

    .snapshot-img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #ffffff;
    }

    .snapshot-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 5px;
        text-align: center;
    }

    .snapshot-match-badge {
        background: rgba(231, 84, 128, 0.1);
        color: var(--brand-pink);
        padding: 6px 15px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        margin-bottom: 25px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .snapshot-details {
        width: 100%;
        background: #f8f9fa;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .snapshot-detail-row {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        font-size: 0.95rem;
    }
    .snapshot-detail-row:last-child { margin-bottom: 0; }
    .snapshot-detail-icon {
        width: 32px;
        height: 32px;
        background: #ffffff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brand-pink);
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .snapshot-actions { width: 100%; display: flex; flex-direction: column; gap: 10px; }
    .btn-full-profile {
        background: #ffffff;
        border: 2px solid var(--border-color);
        color: var(--text-dark);
        font-weight: 600;
        padding: 12px;
        border-radius: 12px;
        transition: all 0.2s;
    }
    .btn-full-profile:hover { border-color: var(--brand-pink); color: var(--brand-pink); }

    /* Mobile Adjustments */
    @media (max-width: 991px) {
        .chat-page-wrapper { padding-top: 70px; padding-bottom: 0; align-items: flex-start; }
        .chat-container { height: calc(100vh - 70px); border-radius: 0; border: none; box-shadow: none; max-width: 100%; }
        .chat-sidebar { display: none !important; }
        .profile-sidebar { display: none !important; }
        .chat-header, .chat-footer { padding: 15px; }
        .chat-body { padding: 15px; }
    }
</style>
@endpush

@section('content')

@php
    // =========================================================
    // SMART DUMMY DATA FOR THE 3-PANE LAYOUT
    // =========================================================
    $recentChats = $recentChats ?? [
        [
            'id' => 1,
            'name' => 'Priya Sharma',
            'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&h=150&fit=crop',
            'last_message' => 'That sounds wonderful! Let\'s talk.',
            'time' => '10:42 AM',
            'unread' => 0,
            'active' => true,
            // Extra info for the Right Pane
            'age' => 26,
            'height' => "5'4\"",
            'location' => 'Mumbai, India',
            'profession' => 'Software Engineer',
            'religion' => 'Hindu - Brahmin',
            'match' => 92
        ],
        [
            'id' => 2,
            'name' => 'Anjali Desai',
            'image' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=150&h=150&fit=crop',
            'last_message' => 'I am currently working in Bangalore.',
            'time' => 'Yesterday',
            'unread' => 2,
            'active' => false
        ],
        [
            'id' => 3,
            'name' => 'Meera Patel',
            'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=150&h=150&fit=crop',
            'last_message' => 'Thanks for accepting my request.',
            'time' => 'Monday',
            'unread' => 0,
            'active' => false
        ]
    ];

    $chatUser = collect($recentChats)->firstWhere('active', true);
    $messages = $messages ?? []; 
@endphp

<div class="chat-page-wrapper px-0 px-md-3">
    <div class="chat-container row g-0">
        
        <div class="col-lg-3 col-md-4 chat-sidebar d-none d-md-flex">
            <div class="sidebar-header">
                <h3>Messages</h3>
                <button class="btn-icon border-0 bg-transparent text-muted fs-4" title="Settings"><i class="bi bi-gear"></i></button>
            </div>
            
            <div class="chat-search">
                <input type="text" class="chat-search-input" placeholder="Search matches...">
            </div>

            <div class="chat-list">
                @foreach($recentChats as $chat)
                <a href="/messages/chat/{{ $chat['id'] }}" class="chat-list-item {{ $chat['active'] ? 'active' : '' }}">
                    <img src="{{ $chat['image'] }}" class="chat-list-avatar" alt="{{ $chat['name'] }}">
                    <div class="chat-list-info">
                        <div class="chat-list-name-time">
                            <h5 class="chat-list-name">{{ $chat['name'] }}</h5>
                            <span class="chat-list-time {{ $chat['unread'] > 0 ? 'text-dark fw-bold' : '' }}">{{ $chat['time'] }}</span>
                        </div>
                        <div class="chat-list-preview">
                            <p class="chat-list-message {{ $chat['unread'] > 0 ? 'text-dark fw-semibold' : '' }}">{{ $chat['last_message'] }}</p>
                            @if($chat['unread'] > 0)
                                <span class="unread-badge">{{ $chat['unread'] }}</span>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <div class="col-lg-6 col-md-8 col-12 chat-main">
            
            <div class="chat-header">
                <div class="d-flex align-items-center gap-3">
                    <a href="javascript:history.back()" class="text-muted d-md-none text-decoration-none">
                        <i class="bi bi-arrow-left fs-3"></i>
                    </a>
                    
                    <div class="chat-user-info">
                        <img src="{{ $chatUser['image'] ?? 'default.jpg' }}" alt="Profile" class="chat-avatar">
                        <div class="chat-user-details">
                            <h4>{{ $chatUser['name'] ?? 'Select a chat' }}</h4>
                            <div class="chat-status">
                                <div class="status-dot"></div> Online
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-header-actions">
                    <button class="btn-icon d-lg-none" title="View Profile" onclick="window.location.href='/profiles/{{ $chatUser['id'] ?? 1 }}'">
                        <i class="bi bi-info-circle"></i>
                    </button>
                    <button class="btn-icon" title="Video Call">
                        <i class="bi bi-camera-video"></i>
                    </button>
                </div>
            </div>

            <div class="chat-body" id="chatBody">
                @if(empty($messages))
                    <div class="empty-chat" id="emptyChatState">
                        <div class="empty-chat-img">
                            <i class="bi bi-chat-heart-fill"></i>
                        </div>
                        <h4 class="font-playfair fw-bold text-dark mb-2">Say Hello to {{ explode(' ', $chatUser['name'])[0] }}!</h4>
                        <p>Break the ice and start a meaningful conversation today.</p>
                    </div>
                @else
                    @foreach($messages as $msg)
                        @endforeach
                @endif
            </div>

            <div class="chat-footer">
                <div class="chat-input-wrapper">
                    <button class="btn-attach" title="Attach Document">
                        <i class="bi bi-paperclip"></i>
                    </button>
                    <textarea 
                        class="chat-input" 
                        id="messageInput" 
                        rows="1" 
                        placeholder="Write your message here..."
                        oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                    <button class="btn-send" title="Send" onclick="sendMessage()">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </div>
            </div>

        </div>

        <div class="col-lg-3 d-none d-lg-flex profile-sidebar">
            <div class="snapshot-img-wrapper">
                <img src="{{ $chatUser['image'] ?? '' }}" alt="Profile" class="snapshot-img">
            </div>
            
            <h3 class="snapshot-name">{{ $chatUser['name'] ?? '' }}</h3>
            
            <div class="snapshot-match-badge">
                <i class="bi bi-heart-fill"></i> {{ $chatUser['match'] ?? 80 }}% Match Score
            </div>

            <div class="snapshot-details">
                <div class="snapshot-detail-row">
                    <div class="snapshot-detail-icon"><i class="bi bi-person"></i></div>
                    <div class="d-flex flex-column text-start">
                        <small class="text-muted" style="font-size: 0.7rem; font-weight:600; text-transform:uppercase;">Age / Height</small>
                        <span class="fw-semibold">{{ $chatUser['age'] ?? '' }} yrs, {{ $chatUser['height'] ?? '' }}</span>
                    </div>
                </div>
                <div class="snapshot-detail-row">
                    <div class="snapshot-detail-icon"><i class="bi bi-geo-alt"></i></div>
                    <div class="d-flex flex-column text-start">
                        <small class="text-muted" style="font-size: 0.7rem; font-weight:600; text-transform:uppercase;">Location</small>
                        <span class="fw-semibold">{{ $chatUser['location'] ?? '' }}</span>
                    </div>
                </div>
                <div class="snapshot-detail-row">
                    <div class="snapshot-detail-icon"><i class="bi bi-briefcase"></i></div>
                    <div class="d-flex flex-column text-start">
                        <small class="text-muted" style="font-size: 0.7rem; font-weight:600; text-transform:uppercase;">Profession</small>
                        <span class="fw-semibold">{{ $chatUser['profession'] ?? '' }}</span>
                    </div>
                </div>
                <div class="snapshot-detail-row">
                    <div class="snapshot-detail-icon"><i class="bi bi-moon-stars"></i></div>
                    <div class="d-flex flex-column text-start">
                        <small class="text-muted" style="font-size: 0.7rem; font-weight:600; text-transform:uppercase;">Religion</small>
                        <span class="fw-semibold">{{ $chatUser['religion'] ?? '' }}</span>
                    </div>
                </div>
            </div>

            <div class="snapshot-actions">
                <a href="/profiles/{{ $chatUser['id'] ?? 1 }}" class="btn btn-full-profile text-center text-decoration-none w-100">
                    View Full Profile
                </a>
                <button class="btn border-0 text-muted mt-2 small" onclick="alert('Profile reported.')"><i class="bi bi-flag me-1"></i> Report / Block</button>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    const chatBody = document.getElementById('chatBody');
    const emptyState = document.getElementById('emptyChatState');

    chatBody.scrollTop = chatBody.scrollHeight;

    document.getElementById('messageInput').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    function sendMessage() {
        const input = document.getElementById('messageInput');
        const text = input.value.trim();

        if (text === '') return;

        if(emptyState) {
            emptyState.style.display = 'none';
        }

        const now = new Date();
        const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        const messageHTML = `
            <div class="message message-sent" style="animation: fadeSlideUp 0.3s ease;">
                <div class="message-bubble">${text.replace(/\n/g, '<br>')}</div>
                <div class="message-time">${timeString} <i class="bi bi-check2 text-white"></i></div>
            </div>
        `;

        chatBody.insertAdjacentHTML('beforeend', messageHTML);
        
        input.value = '';
        input.style.height = 'auto';

        chatBody.scrollTop = chatBody.scrollHeight;
    }
</script>
@endpush