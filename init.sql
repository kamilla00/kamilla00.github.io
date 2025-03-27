-- Создание таблицы программных языков
CREATE TABLE programming_languages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

-- Вставка в таблицу программных языков
INSERT INTO programming_languages (name) VALUES 
('Pascal'), 
('C'),
('C++'),
('JavaScript'),
('PHP'),
('Python'),
('Java'),
('Haskell'),
('Clojure'),
('Prolog'),
('Scala'),
('Go');

-- Создание таблицы заявок
CREATE TABLE application (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100) NOT NULL,
    birth_date DATE,
    gender ENUM('male', 'female', 'other'),
    biography TEXT,
    contract_accepted BOOLEAN,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Создание связи между заявками и языками программирования
CREATE TABLE application_languages (
    application_id INT,
    language_id INT,
    FOREIGN KEY (application_id) REFERENCES application(id),
    FOREIGN KEY (language_id) REFERENCES programming_languages(id)
);