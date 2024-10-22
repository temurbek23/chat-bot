<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SamDU Savol va Javob</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 60%;
            margin: 50px auto;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        label {
            font-size: 16px;
            color: #333;
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        .input-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        textarea {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            resize: vertical;
            box-sizing: border-box;
        }

        button {
            background-color: #2c3e50;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        button:hover {
            background-color: #1abc9c;
        }

        .note {
            color: #999;
            font-size: 14px;
            text-align: center;
        }

        .notification {
            background-color: #d4edda; /* Yashil rang */
            color: #155724; /* Matn rang */
            padding: 15px;
            border-radius: 5px;
            position: fixed;
            top: -100px; /* Dastlab ko'rinmas */
            right: 20px;
            z-index: 1000;
            display: none; /* Dastlab ko'rinmas */
            animation: slideDown 0.5s forwards; /* Animatsiya */
        }

        @keyframes slideDown {
            from {
                top: -100px;
            }
            to {
                top: 20px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Savolingiz va Javobingizni Kiriting</h2>
    <div id="notification" class="notification"></div>
    <form id="questionForm">
        <div class="input-group">
            <label for="question">Savol (Majburiy):</label>
            <textarea id="question" name="question_text" rows="4" placeholder="Savolingizni kiriting..." required></textarea>
        </div>
        <div class="input-group">
            <label for="answer">Javob (Majburiy emas):</label>
            <textarea id="answer" name="answer_text" rows="6" placeholder="Javobingizni kiriting (ixtiyoriy)"></textarea>
        </div>
        <button type="submit">Yuborish</button>
    </form>
    <p class="note">Sharof Rashidov nomidagi Samarqand davlat universiteti - Savol va Javoblaringizni kiritishingiz mumkin</p>
</div>
<script>
    document.getElementById('questionForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Formani yuborishni to'xtatish

        // Savol va javob maydonlarining qiymatlarini olish
        var question = document.getElementById('question').value;
        var answer = document.getElementById('answer').value;

        // AJAX so'rovini yuborish
        fetch("{{ route('question.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // CSRF tokenni qo'shish
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                question_text: question,
                answer_text: answer
            })
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Xatolik yuz berdi');
            })
            .then(data => {
                // Ma'lumot muvaffaqiyatli yuborildi
                var notification = document.getElementById('notification');
                notification.innerHTML = "Savol muvaffaqiyatli yuborildi!";
                notification.style.display = 'block';
                notification.style.opacity = '1';

                // Textarea qiymatlarini tozalash
                document.getElementById('question').value = '';
                document.getElementById('answer').value = '';

                // Xabarni 3 soniya davomida ko'rsatish va keyin o'chirish
                setTimeout(function() {
                    notification.style.opacity = '0';
                    setTimeout(function() {
                        notification.style.display = 'none';
                    }, 500); // 0.5 soniyadan so'ng yashirish
                }, 3000); // 3 soniyadan so'ng
            })
            .catch(error => {
                console.error('Xatolik:', error);

                var notification = document.getElementById('notification');
                notification.innerHTML = "Xatolik yuz berdi. Qayta urinib ko'ring!";
                notification.style.display = 'block';
                notification.style.opacity = '1';

                // Xabarni 3 soniya davomida ko'rsatish va keyin o'chirish
                setTimeout(function() {
                    notification.style.opacity = '0';
                    setTimeout(function() {
                        notification.style.display = 'none';
                    }, 500); // 0.5 soniyadan so'ng yashirish
                }, 3000); // 3 soniyadan so'ng
            });
    });
</script>
</body>
</html>
