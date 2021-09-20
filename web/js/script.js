jQuery(document).ready(function() {

main();

function main() {

  // Получаем массив с датами
  $table = $('td:not(.disable)');

  // Получаем кнопку забронировать
  $btn = $('#btn');

  // Получаем 'span' с уведомалением о успешном бронирование
  // И по умолчанию скрываем её
  $success = $('.booked-success');
  $success.hide();

  // Переменая для добовления id каждому элементу массива
  let i = 0;

  // Запускаем итерирование массива
  $table.each(function() {

    // Добовляем уникальные id каждому элементу массива
    $(this).attr('id', ++i);

    // Вызываем функцию клика по ячейки
    // И передаём в аргумент все ячейки таблицы
    clickOnACell($(this));
  });

  // Вызываем функцию клика по кнопке забронировать
  clickOnAButtonBooking();

  // Вызываем функцию которая получает список забронированых дней
  ajaxSetBookedDays();

}

  // Функция клика по ячейки
  function clickOnACell(cell) {

    // Добовляем класс при клике
    cell.on('click', function() {
      cell.toggleClass('text-white bg-success select');

      // Если у ячеек есть класс 'select'
      // Показываем кнопку зобронировать
      if($('td').hasClass('select')) {

        // Скрывем уведомление о успешном бронирование
        // Если выбраны ещё ячейки
        $success.hide();

        // Показываем кнопку забронировать
        $btn.show();

      } else {

        // Скрываем кнопку забронировать
        $btn.hide();

      }
    })
  }

  // Функция клика по кнопке забронировать
  function clickOnAButtonBooking() {

    $btn.on('click', function() {

      // Получаем все элементы с классом 'select'
      let select = $('.select');

      // Запускаем итертрование всех элементов с классом 'select'
      select.each(function() {

        // Вызываем функцию Ajax запроса
        // Передаём массив со значением равным содержанию ячейки
        ajaxQuery({data: $(this).text()});

      })

      // Меняем цвет ячейки
      select.removeClass('bg-success');
      select.addClass('bg-danger');

      // Запрет клика по забронированой ячейке
      select.off('click');

    })
  }

  // Ajax запрос
  // Отправляет выбранные даты

  function ajaxQuery(data) {
    $.ajax({
      url: 'site/index',
      type: 'POST',
      data: data,
      success: function(response) {

        // Скрывем кнопку при успешном запросе
        $btn.hide();

        // Показывем уведомаление о успешном бронирование
        $success.show();

      },
      error: function() {
        alert('Error');
      }
    })
  }

  // Ajax запрос
  // Получает список уже забронированых дат при загрузке страницы
  function ajaxSetBookedDays() {

    $.ajax({
      url: 'site/index',
      type: 'GET',
      contentType: 'application/json',
      success: function(data) {

        // Разбираем полученый JSON
        data = JSON.parse(data);
        var i = 0;

        // Перебираем массив полученый из JSON
        while(i < data.length) {
          
          // Делаем выборку по id
          // В качестве значений id берем содержимое объектов JSON
          // С ключом 'booked'
          let bookedDays = $('#' + String(data[i]['booked']));

          // Добавляем класс выбраным элементам
          // Которые уже есть в БД
          bookedDays.addClass('text-white bg-danger');

          // Запрещаем клик
          bookedDays.off('click');
          i++
        }
      },
      error: function() {
        alert('Error');
      }
    })
  }
});