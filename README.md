### Hexlet tests and linter status:
[![Actions Status](https://github.com/bayanict/php-project-lvl2/workflows/hexlet-check/badge.svg)](https://github.com/bayanict/php-project-lvl2/actions)
[![PHP CI](https://github.com/bayanict/php-project-lvl2/actions/workflows/actions.yml/badge.svg)](https://github.com/bayanict/php-project-lvl2/actions/workflows/actions.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/10570c2a6372e0f5aa33/maintainability)](https://codeclimate.com/github/bayanict/php-project-lvl2/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/10570c2a6372e0f5aa33/test_coverage)](https://codeclimate.com/github/bayanict/php-project-lvl2/test_coverage)

# Описание проекта
<b>«Вычислитель отличий»</b> – программа, определяющая разницу между двумя структурами данных. Это популярная задача, для решения которой существует множество онлайн-сервисов, например: http://www.jsondiff.com/. Подобный механизм используется при выводе тестов или при автоматическом отслеживании изменении в конфигурационных файлах.

Возможности утилиты:
- Поддержка разных входных форматов: yaml и json
- Генерация отчета в виде plain text, stylish и json

# Минимальные требования
* php (version 8.1)
* composer (version 2.1.12)
* make (version 4.3)

# Инструкция по установке и запуску
```
git clone https://github.com/bayanict/php-project-lvl2.git
make install    # в директории проекта
cd bin/         #переход в директорию с исполняемым файлом
./gendiff --help
```

# Примеры использования
## 1. Сравнение файлов JSON (вывод в форматах Stylish, Plain, Json)
<a href="https://asciinema.org/a/cxtmu7qRm3dJTjYplFe3UiKso" target="_blank"><img src="https://asciinema.org/a/cxtmu7qRm3dJTjYplFe3UiKso.svg" /></a>

## 2. Сравнение файлов YAML (вывод в форматах Stylish, Plain, Json)
<a href="https://asciinema.org/a/pJnLZFXGHzDlbdhrwLGHo6gOi" target="_blank"><img src="https://asciinema.org/a/pJnLZFXGHzDlbdhrwLGHo6gOi.svg" /></a>