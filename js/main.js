document.querySelectorAll('.contact-form').forEach(function(form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const overlay = document.getElementById('overlay');
        // const submitBtn = this.querySelector('.submitBtn');

        // Hiện overlay + disable nút
        overlay.style.display = 'flex';
        submitBtn.disabled = true;

        let formData = new FormData(this);

        fetch('sendmail.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            overlay.style.display = 'none';
            submitBtn.disabled = false;
            alert(data.message);
            if (data.status === 'success') {
                this.reset(); // reset form hiện tại
                location.reload(); // reload trang
            }
        })
        .catch(err => {
            overlay.style.display = 'none';
            submitBtn.disabled = false;
            alert('Có lỗi xảy ra khi gửi thông tin!');
            location.reload();
        });
    });
});