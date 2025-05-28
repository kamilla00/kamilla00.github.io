// Registr.js -- Валидация, Отправка формы через Fetch
// Словарь ошибок для каждого поля формы
const fielderrors = {
    name: "Укажите полное ФИО на кириллице — фамилию, имя и отчество, разделённые пробелами. Допустимы только буквы, минимум три слова (например: Петров Иван Сергеевич).",
    phone: "Введите номер телефона в формате +XXXXXXXXXXX. Разрешены только цифры после знака '+'.",
    email: "Введите корректный email в формате username@domain.com. Допустимы буквы, цифры, точки, дефисы и символ '@'.",
    dob: "Введите дату рождения в формате ГГГГ-ММ-ДД.",
    gender: "Выберите пол: «М» (мужской) или «Ж» (женский). Это поле обязательно.",
    languages: "Укажите хотя бы один язык программирования из предложенного списка. Можно выбрать несколько.",
    bio: "Допускается ввод букв (кириллица и латиница), цифр, пробелов и символов: \";,.:-!?\".",
    contract: "Для продолжения необходимо подтвердить согласие с условиями, установив флажок."
};

document.addEventListener("DOMContentLoaded", function() {
    const forma = document.getElementById("regform");
    console.log(forma)
    // Создаём скрытые блоки для сообщений об ошибках

    for (const [field, message] of Object.entries(fielderrors)) {
        const input = forma.querySelector(`[name="${field}"]`);
        if (!input) {
            console.warn(`Поле с name="${field}" не найдено`);
            continue;
        }

        const errorEl = document.createElement("p");
        errorEl.className = "error-message";
        errorEl.textContent = fielderrors[field];
        errorEl.dataset.for = field;
        errorEl.style.color = "red";
        errorEl.style.fontSize = "1rem";
        errorEl.style.display = "none";
        input.parentNode.insertBefore(errorEl, input); // Вставка ошибки перед полем
    }

    forma.addEventListener("submit", (e) => {
        e.preventDefault(); // Предотвращаем стандартную отправку формы
        console.log(e)
        // Сброс предыдущих ошибок
        forma.querySelectorAll('.error').forEach(input => input.classList.remove('error'));
        forma.querySelectorAll('.error-message').forEach(el => el.style.display = 'none');

        const formData = new FormData(e.target);
        const validationResult = validate(formData); // Проверка данных

        if (validationResult) {
            // Отображает ошибки под соответствующими полями
            for (const [field, message] of Object.entries(validationResult)) {
                const input = forma.querySelector(`[name="${field}"]`);
                const errorEl = forma.querySelector(`.error-message[data-for="${field}"]`);
                if (input && errorEl) {
                    input.classList.add('error');
                    errorEl.style.display = 'block';
                } else {
                    console.warn(`Не найдены элементы для поля: ${field}`);
                }
            }
        } else {
            // Подготовка данных к отправке
            const formObject = Object.fromEntries(formData.entries());
            formObject.languages = formData.getAll("languages");
            formObject.contract = formData.get("contract") || null;

            // Отправка данных через fetch
            fetch(e.target.action, {
                method: e.target.method,
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(formObject),
            }).then(res => res.json())
              .then(data => {
                  if (data.redirect_url) {
                      window.location.href = data.redirect_url; // Переход по редиректу
                  }
              })
              .catch(err => console.error(err));
        }
    });
});






// Выполняет проверку полей формы
const validate = (data) => {
    const errors = {};

    // Проверка ФИО
    if (data.get("name")) {
        const fioRegex = /^[a-zA-Zа-яА-ЯёЁ]{1,}\s[a-zA-Zа-яА-ЯёЁ]{1,}\s[a-zA-Zа-яА-ЯёЁ]{1,}$/;
        if (!fioRegex.test(data.get("name"))) {
            errors.name = "Invalid name";
        }
    } else {
        errors.name = "Name is required";
    }

    // Проверка телефона
    if (data.get("phone")) {
        const telRegex = /^\+[0-9]{1,29}$/;
        if (!telRegex.test(data.get("phone"))) {
            errors.phone = "Invalid phone";
        }
    } else {
        errors.phone = "Tel is required";
    }

    // Проверка email
    if (data.get("email")) {
        const emailRegex = /^[A-Za-z0-9._%+-]{1,30}@[A-Za-z0-9.-]{1,20}\.[A-Za-z]{1,10}$/;
        if (!emailRegex.test(data.get("email"))) {
            errors.email = "Invalid email";
        }
    } else {
        errors.email = "Email is required";
    }

    // Проверка даты рождения
    if (data.get("dob")) {
        const dateRegex = /^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/;
        if (!dateRegex.test(data.get("dob"))) {
            errors.dob = "Invalid date";
        }
    } else {
        errors.dob = "Date is required";
    }

    // Проверка пола
    if (!["male", "female"].includes(data.get("gender"))) {
        errors.gender = "Invalid gender";
    }

    // Проверка соглашения
    if (data.get("contract") !== "on") {
        errors.contract = "Invalid contract checkbox";
    }

    // Проверка языков
    if (data.getAll("languages")?.length === 0) {
        errors.languages = "Favourite langs are required";
    }

    // Проверка биографии
    if (data.get("bio")) {
        const bioRegex = /^[A-Za-zА-Яа-яЁё;,.:0-9\-!?""\s]{0,}$/;
        if (!bioRegex.test(data.get("bio"))) {
            errors.bio = "Invalid Bio";
        }
    }

    return Object.keys(errors).length === 0 ? null : errors;
};
