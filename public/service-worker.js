self.addEventListener('push', function(event) {
    const options = {
        body: event.data.text(),
        icon: 'icon.png', // تأكد من أن الأيقونة موجودة في مجلد public
        sound: 'sounds/sound.mp3' // تأكد من أن الصوت موجود
    };

    event.waitUntil(
        self.registration.showNotification('تنبيه', options)
    );
});
