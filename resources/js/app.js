import './bootstrap';

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js')
    .then(function(registration) {
        console.log('Service Worker registered with scope:', registration.scope);
    })
    .catch(function(error) {
        console.error('Service Worker registration failed:', error);
    });

    // طلب إذن المستخدم
    Notification.requestPermission().then(function(permission) {
        if (permission === 'granted') {
            // يمكنك هنا إرسال إشعار
            showNotification();
        }
    });
}

// دالة لإرسال إشعار
function showNotification() {
    const options = {
        body: 'هذا هو تنبيهك!',
        icon: 'icon.png',
        sound: 'sounds/sound.mp3' // تأكد من أن الصوت موجود
    };
    new Notification('تنبيه', options);
}
