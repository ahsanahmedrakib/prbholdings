<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Icon extends Component
{
    public function __construct(
        public string $name = 'sparkles',
        public string $class = 'size-6',
    ) {}

    public function render(): View
    {
        return view('components.icon');
    }

    public function paths(): string
    {
        $stroke = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" class="'.$this->class.'" aria-hidden="true">';

        $icons = [
            'shield' => '<path d="M12 3 4.5 6v5.5c0 4.6 3.2 8.2 7.5 9.5 4.3-1.3 7.5-4.9 7.5-9.5V6L12 3Z"/><path d="m9 12 2 2 4-4"/>',
            'car' => '<path d="M5 17h14M6 17l-1.2-5.2A2 2 0 0 1 6.7 9h10.6a2 2 0 0 1 1.9 2.8L18 17"/><path d="M7 19a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3ZM17 19a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"/><path d="M8 13h8"/>',
            'bolt' => '<path d="M13 2 4.5 13.5H11l-1 8.5L19.5 10H13l0-8Z"/>',
            'users' => '<path d="M16 20v-1.5a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4V20"/><circle cx="9" cy="7" r="3.5"/><path d="M22 20v-1.5a4 4 0 0 0-3-3.87M16 3.6a3.5 3.5 0 0 1 0 6.8"/>',
            'leaf' => '<path d="M20 4c-8.5 0-14 4-14 10a6 6 0 0 0 6 6c6 0 8-6 8-16Z"/><path d="M4 21c1.5-5 5-8.5 10-11"/>',
            'map' => '<path d="m9 18-6 3V6l6-3 6 3 6-3v15l-6 3-6-3Z"/><path d="M9 3v15M15 6v15"/>',
            'tools' => '<path d="M14.7 6.3a4 4 0 0 0-5.4 5.4L3 18v3h3l6.3-6.3a4 4 0 0 0 5.4-5.4l-2.7 2.7-2-2 2.7-2.7Z"/>',
            'sun' => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>',
            'sparkles' => '<path d="m12 3 1.8 4.6L18 9.5l-4.2 1.9L12 16l-1.8-4.6L6 9.5l4.2-1.9L12 3Z"/><path d="M19 15.5 19.8 17.5 22 18.3l-2.2.8L19 21l-.8-1.9-2.2-.8 2.2-.8L19 15.5ZM5 3.5 5.6 5l1.9.5-1.9.6L5 7.5l-.6-1.4L2.5 5.5l1.9-.5L5 3.5Z"/>',
            'building' => '<path d="M4 21V5a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v16M15 9h3a2 2 0 0 1 2 2v10M2 21h20"/><path d="M8 7h3M8 11h3M8 15h3M8 19h3M18 13h.01M18 17h.01"/>',
            'check' => '<path d="m5 12 4 4L19 6"/>',
            'phone' => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.8 2Z"/>',
            'mail' => '<rect x="2.5" y="4.5" width="19" height="15" rx="2.5"/><path d="m3 6 9 6.5L21 6"/>',
            'pin' => '<path d="M20 10c0 5.5-8 12-8 12S4 15.5 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/>',
            'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/>',
            'calendar' => '<rect x="3" y="4.5" width="18" height="16.5" rx="2.5"/><path d="M8 2.5v4M16 2.5v4M3 9h18M8 13h.01M12 13h.01M16 13h.01M8 17h.01M12 17h.01"/>',
            'arrow-right' => '<path d="M4 12h16M13 5l7 7-7 7"/>',
            'arrow-left' => '<path d="M20 12H4M11 5l-7 7 7 7"/>',
            'arrow-up-right' => '<path d="M7 17 17 7M8 7h9v9"/>',
            'arrow-up' => '<path d="M12 20V4M5 11l7-7 7 7"/>',
            'chevron-down' => '<path d="m6 9 6 6 6-6"/>',
            'chevron-right' => '<path d="m9 6 6 6-6 6"/>',
            'chevron-left' => '<path d="m15 6-6 6 6 6"/>',
            'facebook' => '<path d="M14 8h3V4.5h-3A4.5 4.5 0 0 0 9.5 9v3H7v3.5h2.5V22H13v-6.5h3l.5-3.5H13V9a1 1 0 0 1 1-1Z"/>',
            'instagram' => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.2" cy="6.8" r="0.8" fill="currentColor" stroke="none"/>',
            'linkedin' => '<path d="M6.5 9.5V20M6.5 5.5v.01M11 20v-6a3 3 0 0 1 6 0v6M11 9.5V20"/>',
            'youtube' => '<path d="M22 12s0-3.3-.4-4.8a2.4 2.4 0 0 0-1.7-1.7C18.4 5 12 5 12 5s-6.4 0-7.9.5a2.4 2.4 0 0 0-1.7 1.7C2 8.7 2 12 2 12s0 3.3.4 4.8a2.4 2.4 0 0 0 1.7 1.7C5.6 19 12 19 12 19s6.4 0 7.9-.5a2.4 2.4 0 0 0 1.7-1.7C22 15.3 22 12 22 12Z"/><path d="m10 9 5 3-5 3V9Z"/>',
            'whatsapp' => '<path d="M20.5 11.6a8.5 8.5 0 0 1-12.6 7.5L3.5 20.5l1.4-4.4a8.5 8.5 0 1 1 15.6-4.5Z"/><path d="M9 9.5c.3 2.6 2.4 4.7 5 5 .8.1 1.3-.4 1.5-1l.2-.7-1.9-.8-.7.8c-1-.5-1.8-1.3-2.3-2.3l.8-.7-.8-1.9-.7.2c-.6.2-1.1.7-1.1 1.4Z"/>',
            'star' => '<path d="m12 3 2.7 5.6 6.3.9-4.5 4.4 1 6.1L12 17l-5.5 3 1-6.1L3 9.5l6.3-.9L12 3Z" fill="currentColor" stroke="none"/>',
            'quote' => '<path d="M9.5 6C6.5 7.5 5 10 5 13.5V18h5v-5H7.5c0-2 .8-3.5 2.8-4.5L9.5 6ZM19.5 6C16.5 7.5 15 10 15 13.5V18h5v-5h-2.5c0-2 .8-3.5 2.8-4.5L19.5 6Z" fill="currentColor" stroke="none"/>',
            'menu' => '<path d="M4 7h16M4 12h16M4 17h16"/>',
            'close' => '<path d="m6 6 12 12M18 6 6 18"/>',
            'lift' => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M12 3v18M8.5 8 10 6.5 11.5 8M8.5 16 10 17.5 11.5 16M15.5 9.5 17 8M15.5 14.5 17 16"/>',
            'area' => '<path d="M4 8V4h4M16 4h4v4M20 16v4h-4M8 20H4v-4"/><path d="M8 12h8"/>',
            'compass' => '<circle cx="12" cy="12" r="9"/><path d="m15.5 8.5-2 5-5 2 2-5 5-2Z"/>',
            'floors' => '<path d="m12 3 9 5-9 5-9-5 9-5ZM3 12l9 5 9-5M3 16l9 5 9-5"/>',
            'document' => '<path d="M14 2.5H6.5A2 2 0 0 0 4.5 4.5v15a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V8l-5.5-5.5Z"/><path d="M14 2.5V8h5M8 13h8M8 17h5"/>',
            'download' => '<path d="M12 3v12M7 10l5 5 5-5M4 20h16"/>',
            'home' => '<path d="m3 10 9-7 9 7v9a2 2 0 0 1-2 2h-4v-7H9v7H5a2 2 0 0 1-2-2v-9Z"/>',
            'search' => '<circle cx="11" cy="11" r="7"/><path d="m16.5 16.5 4 4"/>',
            'play' => '<path d="M8 5.5v13l11-6.5-11-6.5Z"/>',
            'trash' => '<path d="M4 7h16M9 7V4.5h6V7M6 7l1 13h10l1-13M10 11v6M14 11v6"/>',
            'edit' => '<path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4L16.5 3.5Z"/>',
            'plus' => '<path d="M12 5v14M5 12h14"/>',
            'image' => '<rect x="3" y="3" width="18" height="18" rx="2.5"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/>',
            'dashboard' => '<rect x="3" y="3" width="7" height="9" rx="1.5"/><rect x="14" y="3" width="7" height="5" rx="1.5"/><rect x="14" y="12" width="7" height="9" rx="1.5"/><rect x="3" y="16" width="7" height="5" rx="1.5"/>',
            'settings' => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.5 1.7 1.7 0 0 0-1.9.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1.1 1.7 1.7 0 0 0-.3-1.9l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.9.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.9-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.9V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1Z"/>',
            'logout' => '<path d="M10 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5M15 16l5-4-5-4M20 12H9"/>',
            'more' => '<circle cx="5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/>',
            'eye' => '<path d="M2.5 12S6 5.5 12 5.5 21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12Z"/><circle cx="12" cy="12" r="3"/>',
        ];

        $content = $icons[$this->name] ?? $icons['sparkles'];

        return $stroke.$content.'</svg>';
    }
}