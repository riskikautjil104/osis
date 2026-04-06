<style>
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.95);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s;
    }
    
    .loading-spinner {
        text-align: center;
    }
    
    .spinner-ring {
        display: inline-block;
        width: 80px;
        height: 80px;
    }
    
    .spinner-ring:after {
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: 8px;
        border-radius: 50%;
        border: 6px solid #0F6E56;
        border-color: #0F6E56 transparent #0F6E56 transparent;
        animation: spinner-ring 1.2s linear infinite;
    }
    
    @keyframes spinner-ring {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .loading-text {
        margin-top: 20px;
        font-size: 14px;
        color: #0F6E56;
        font-weight: 600;
        letter-spacing: 1px;
    }
    
    .loading-dots {
        display: inline-block;
    }
    
    .loading-dots span {
        animation: blink 1.4s infinite both;
    }
    
    .loading-dots span:nth-child(2) {
        animation-delay: 0.2s;
    }
    
    .loading-dots span:nth-child(3) {
        animation-delay: 0.4s;
    }
    
    @keyframes blink {
        0%, 80%, 100% { opacity: 0; }
        40% { opacity: 1; }
    }
</style>

<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner">
        <div class="spinner-ring"></div>
        <div class="loading-text">
            Memuat data
            <span class="loading-dots">
                <span>.</span><span>.</span><span>.</span>
            </span>
        </div>
    </div>
</div>

<script>
    // Hide loading after page load
    window.addEventListener('load', function() {
        setTimeout(function() {
            const loading = document.getElementById('loadingOverlay');
            if (loading) {
                loading.style.opacity = '0';
                setTimeout(function() {
                    loading.style.display = 'none';
                }, 500);
            }
        }, 500);
    });
    
    // Show loading on page transition (for links)
    document.addEventListener('click', function(e) {
        let target = e.target.closest('a');
        if (target && target.href && !target.href.includes('#') && target.target !== '_blank') {
            const loading = document.getElementById('loadingOverlay');
            if (loading) {
                loading.style.display = 'flex';
                loading.style.opacity = '1';
            }
        }
    });
</script>