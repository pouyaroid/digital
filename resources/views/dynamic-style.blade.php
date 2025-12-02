
:root {
    --nav-active-gradient: {{ setting('nav_active_gradient', 'linear-gradient(135deg, #8d6e63, #a1887f)') }};
    --nav-active-text: {{ setting('nav_active_text', '#ffffff') }};
    --nav-btn-text: {{ setting('nav_btn_text', '#8d6e63') }};
    --header-banner-gradient: {{ setting('header_banner_gradient', 'linear-gradient(135deg, #8d6e63 0%, #a1887f 50%, #bcaaa4 100%)') }};
    --body-background: {{ setting('body_background', 'linear-gradient(135deg, #f5f1eb 0%, #ff7700 50%, #d4b08c 100%)') }};
    --body-text-color: {{ setting('body_text_color', '#3e2723') }};
    --font-family: {{ setting('font_family', "'Vazirmatn', 'Tajawal', 'Cairo'") }};
    --footer-gradient: {{ setting('footer_gradient', 'linear-gradient(135deg, #ff4400 0%, #6d4c41 100%)') }};
    --footer-text-color: {{ setting('footer_text_color', '#000000') }};
}


body {
    background: var(--body-background);
    color: var(--body-text-color);
    font-family: var(--font-family);
}

.nav-btn.active {
    background: var(--nav-active-gradient);
    color: var(--nav-active-text);
}

.nav-btn {
    color: var(--nav-btn-text);
}

.header-banner {
    background: var(--header-banner-gradient);
}

footer {
    background: var(--footer-gradient);
    color: var(--footer-text-color);
}

