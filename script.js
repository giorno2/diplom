function openTab(tabName, btn) {
            var i, tabcontent, tabBtns;

            // Скрываем все вкладки
            tabcontent = document.getElementsByClassName("tab");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            document.getElementById(tabName).style.display = "block";

            // Убираем активный класс со всех кнопок
            tabBtns = document.getElementsByClassName("tab-btn");
            for (i = 0; i < tabBtns.length; i++) {
                tabBtns[i].classList.remove("active-btn");
            }
            // Добавляем активный класс к текущей кнопке
            btn.classList.add("active-btn");
        }

        // Устанавливаем активную вкладку при загрузке страницы
        window.onload = function() {
            document.getElementById("tb1").click();
        };



let count = 0;
let delIdsArr = [];

function fun_ro(data) {
  let objects = JSON.parse(data);

  objects.forEach(obj => {
    let newElement = document.createElement('div');
    newElement.id = 'krs';

    createReadonlyInputElement('text', 'nazv[]', 'Вид', obj.name, newElement);

    if (obj.uch_zav) {
      createReadonlyInputElement('text', 'uch_zav[]', 'Учебное заведение', obj.uch_zav, newElement);
    }

    if (obj.date_start) {
      createReadonlyInputElement('date', 'date_start[]', 'Дата начала', obj.date_start, newElement);
    }

    if (obj.date_end) {
      createReadonlyInputElement('date', 'date_end[]', 'Дата конца', obj.date_end, newElement);
    }
    if (obj.spec) {
      createReadonlyInputElement('text', 'spec[]', 'Спец', obj.spec, newElement);
    }
    if (obj.kvl) {
      createReadonlyInputElement('text', 'kvl[]', 'Квалификация', obj.kvl, newElement);
    }
    if (obj.kl_c) {
      createReadonlyInputElement('text', 'kl_c[]', 'Кол-во часов', obj.kl_c, newElement);
    }

    createReadonlyInputElement('hidden', 'type[]', "", obj.type, newElement);

    let input4 = document.createElement('input');
    input4.setAttribute('type', 'hidden');
    input4.setAttribute('name', 'kurs_id[]');
    input4.setAttribute('value', obj.id);
    newElement.appendChild(input4);

    if (obj.type == 1) {
      document.getElementById('tab1').appendChild(newElement);
    } else {
      document.getElementById('tab2').appendChild(newElement);
    }

    count++;
    document.getElementById('t').value = count;
  });
}

function fun(data) {
  let objects = JSON.parse(data);

  objects.forEach(obj => {
    let newElement = document.createElement('div');
    newElement.id = 'krs';

    createInputElement('text', 'nazv[]', 'Вид', obj.name, newElement);

    if (obj.uch_zav) {
      createInputElement('text', 'uch_zav[]', 'Учебное заведение', obj.uch_zav, newElement);
    }

    if (obj.date_start) {
      createInputElement('date', 'date_start[]', 'Дата начала', obj.date_start, newElement);
    }

    if (obj.date_end) {
      createInputElement('date', 'date_end[]', 'Дата конца', obj.date_end, newElement);
    }
    if (obj.spec) {
      createInputElement('text', 'spec[]', 'Спец', obj.spec, newElement);
    }
    if (obj.kvl) {
      createInputElement('text', 'kvl[]', 'Квалификация', obj.kvl, newElement);
    }
    if (obj.kl_c) {
      createInputElement('text', 'kl_c[]', 'Кол-во часов', obj.kl_c, newElement);
    }

    createInputElement('hidden', 'type[]', "", obj.type, newElement);

    let input4 = document.createElement('input');
    input4.setAttribute('type', 'hidden');
    input4.setAttribute('name', 'kurs_id[]');
    input4.setAttribute('value', obj.id);
    newElement.appendChild(input4);

    let button = createButtonElement('pic/x-solid.svg', newElement);

    if (obj.type == 1) {
      document.getElementById('tab1').appendChild(newElement);
    } else {
      document.getElementById('tab2').appendChild(newElement);
    }

    count++;
    document.getElementById('t').value = count;

    button.addEventListener('click', function () {
      let confirmDelete = confirm("Вы уверены, что хотите удалить этот элемент?");
      if (confirmDelete) {
        newElement.remove();
        count--;
        document.getElementById('t').value = count;

        delIdsArr.push(obj.id);
        document.getElementById('del_id').value = delIdsArr.join(",");
      }
    });
  });
}



function fun0(data) {
  let objects = JSON.parse(data);
  objects.reverse(); // Reverse the order of the objects

  objects.forEach(obj => {
    let newElement = document.createElement('div');
    newElement.id = 'krs';

    createInputElement('text', 'nazv[]', 'Вид', obj.name, newElement);

    if (obj.uch_zav) {
      createInputElement('text', 'uch_zav[]', 'Учебное завидение', obj.uch_zav, newElement);
    }

    if (obj.date_start) {
      createInputElement('date', 'date_start[]', 'Дата начала', obj.date_start, newElement);
    }

    if (obj.date_end) {
      createInputElement('date', 'date_end[]', 'Дата конца', obj.date_end, newElement);
    }
    if (obj.spec) {
      createInputElement('text', 'spec[]', 'Спец', obj.spec, newElement);
    }
    if (obj.kvl) {
      createInputElement('text', 'kvl[]', 'Квалификация', obj.kvl, newElement);
    }
    if (obj.kl_c) {
      createInputElement('text', 'kl_c[]', 'Кол-во часов', obj.kl_c, newElement);
    }
    createInputElement('hidden', 'type[]', "", obj.type, newElement);

    let input4 = document.createElement('input');
    input4.setAttribute('type', 'hidden');
    input4.setAttribute('name', 'kurs_id[]');
    input4.setAttribute('value', obj.id);
    newElement.appendChild(input4);

    let button = createButtonElement('pic/x-solid.svg', newElement);

    if (obj.type == 1) {
      document.getElementById('tab1').appendChild(newElement);
    } else {
      document.getElementById('tab2').appendChild(newElement);
    }

    count++;
    document.getElementById('t').value = count;

    button.addEventListener('click', function () {
      let confirmDelete = confirm("Вы уверены, что хотите удалить этот элемент?");
      if (confirmDelete) {
        newElement.remove();
        count--;
        document.getElementById('t').value = count;

        delIdsArr.push(obj.id);
        document.getElementById('del_id').value = delIdsArr.join(",");
      }
    });
  });
}

function createInputElement(type, name, placeholder, value, parentElement) {
  if (type !== 'hidden') {
      let labelElement = document.createElement('label');
      labelElement.innerText = placeholder + ': ';
      parentElement.appendChild(labelElement);
  }

  let input = document.createElement('input');
  input.setAttribute('type', type);
  input.setAttribute('name', name);
  input.setAttribute('placeholder', placeholder);
  input.value = value;

  if (type !== 'hidden') {
      parentElement.appendChild(input);
  } else {
      parentElement.appendChild(input); // Добавление поля типа hidden без label
  }
}

function createReadonlyInputElement(type, name, placeholder, value, parentElement) {
  if (type !== 'hidden') {
      let labelElement = document.createElement('label');
      labelElement.innerText = placeholder + ': ';
      parentElement.appendChild(labelElement);
  }

  let input = document.createElement('input');
  input.readOnly = true
  input.setAttribute('type', type);
  input.setAttribute('name', name);
  input.setAttribute('placeholder', placeholder);
  input.value = value;

  if (type !== 'hidden') {
      parentElement.appendChild(input);
  } else {
      parentElement.appendChild(input); // Добавление поля типа hidden без label
  }
}

function createButtonElement(src, parentElement) {
  let button = document.createElement('button');
  button.setAttribute('type', 'button');
  button.id = 'del';

  let img = document.createElement('img');
  img.setAttribute('src', src);
  img.setAttribute('alt', '');
  img.setAttribute('width', '56.57px');
  img.setAttribute('height', '56.57px');

  button.appendChild(img);
  parentElement.appendChild(button);

  return button;
}

function createSelectElement(name, id, parentElement, data_2, data) {
  let select = document.createElement('select');
  select.setAttribute('name', name);
  select.setAttribute('id', id);

  for (let i = 0; i < data_2.length; i++) {
      let option = document.createElement('option');
      option.innerText = data_2[i].name;
      option.value = data_2[i].id;
      if (data_2[i].id === data.type) {
          option.setAttribute('selected', 'selected');
      }
      select.appendChild(option);
  }

  parentElement.appendChild(select);
  return select;
}

function krs_n() {
  let newElement = document.createElement('div');
  newElement.id = 'krs';

  createInputElement('text', 'nazv[]', 'Вид', "" , newElement);
  createInputElement('text', 'uch_zav[]', 'Учебное заведение', "" , newElement);
  createInputElement('date', 'date_start[]', 'Дата начала', "" , newElement);
  createInputElement('date', 'date_end[]', 'Дата конца', "" , newElement);
  createInputElement('text', 'spec[]', 'Спец', "", newElement);
  createInputElement('text', 'kvl[]', 'Квалификация','', newElement);
  createInputElement('text', 'kl_c[]', 'Кол-во часов','', newElement);
  createInputElement('hidden', 'th', "new" , 'new', newElement);
  createInputElement('hidden', 'type[]', "1" , '1', newElement);

  let input4 = document.createElement('input');
  input4.setAttribute('type', 'hidden');
  input4.setAttribute('name', 'kurs_id[]');
  input4.setAttribute('value', 0);
  newElement.appendChild(input4);

  let button = document.createElement('button');
  button.setAttribute('type', 'button');
  button.id = 'del';

  let img = document.createElement('img');
  img.setAttribute('src', 'pic/x-solid.svg');
  img.setAttribute('alt', '');
  img.setAttribute('width', '56.57px');
  img.setAttribute('height', '56.57px');

  button.appendChild(img);
  newElement.appendChild(button);

  let krsNewElement = document.getElementById('krs_new');
  krsNewElement.parentNode.insertBefore(newElement, krsNewElement.nextSibling); // insert after krs_new

  count++; // assuming count is a global variable

  document.getElementById('t').value = count;

  button.addEventListener('click', function() {
    let confirmDelete = confirm("Вы уверены, что хотите удалить этот элемент?");
    if (confirmDelete) {
        newElement.remove();
        count--;
        document.getElementById('t').value = count;
    }
  });
}

function funq(dataArr, data_2, $l, data_3) {
  dataArr.forEach(data => {
    let newElement = document.createElement('div');
    newElement.id = 'krs';

    function createInput(type, name, placeholder, value) {
      let input = document.createElement('input');
      input.setAttribute('type', type);
      input.setAttribute('name', name);
      input.setAttribute('placeholder', placeholder);
      input.setAttribute('value', value);
      newElement.appendChild(input);
      return input;
    }

    let input1 = createInput('text', 'nazv[]', 'название', data.name);
    let input2 = createInput('text', 'opis[]', 'описание', data.opis);
    let input3 = createInput('date', 'date[]', 'дата', data.date);
    let input4 = createInput('hidden', 'id[]', '' , data.id);

    let select = document.createElement('select');
    select.setAttribute('name', 'type[]');
    select.setAttribute('id', 'tp');

    data_3.forEach(item => {
      let option = document.createElement('option');
      option.innerText = item.name;
      option.value = item.id;
      if (item.id === data.type) {
        option.setAttribute('selected', 'selected');
      }
      select.appendChild(option);
    });

    newElement.appendChild(select);

    let selectPrep = document.createElement('select');
    selectPrep.setAttribute('name', 'prep[]');
    selectPrep.id = 'tp';

    data_2.slice(0, $l).forEach(item => {
      let option = document.createElement('option');
      option.value = `${item.id}`;
      option.innerText = `${item.name} ${item.surname} ${item.patronymic}`;
      if (item.id === data.prep_id) {
        option.setAttribute('selected', 'selected');
      }
      selectPrep.appendChild(option);
    });

    newElement.appendChild(selectPrep);

    document.getElementById('kr_m').appendChild(newElement);

    count++;

    let button = createButtonElement('pic/x-solid.svg', newElement, data.id);

    button.addEventListener('click', function() {
      let confirmDelete = confirm("Вы уверены, что хотите удалить этот элемент?");
      if (confirmDelete) {
          newElement.remove();
          count--;
          document.getElementById('t').value = count;

          delIdsArr.push(data.id);
          document.getElementById('del_id').value = delIdsArr.join(",");
      }
  });
  });

  document.getElementById('t').value = count;
}


function oncl(data_2, $l, data_3) {
  let newElement = document.createElement('div');
  newElement.id = 'krs';

  function createInput(type, name, placeholder,value) {
      let input = document.createElement('input');
      input.setAttribute('type', type);
      input.setAttribute('name', name);
      input.setAttribute('placeholder', placeholder);
      input.setAttribute('value', value);
      newElement.appendChild(input);
      return input;
  }

  let input1 = createInput('text', 'nazv[]', 'название' , '');
  let input2 = createInput('text', 'opis[]', 'описание', '');
  let input3 = createInput('date', 'date[]', 'дата', '');

  let select = document.createElement('select');
  select.setAttribute('name', 'type[]');
  select.setAttribute('id', 'tp');

  let valuesArr = data_3.map(item => item.name);
  data_3.forEach(item => {
      let option = document.createElement('option');
      option.innerText = item.name;
      option.value = item.id;
      if (item.id === data.type) {
          option.setAttribute('selected', 'selected');
      }
      select.appendChild(option);
  });

  newElement.appendChild(select);

  let selectPrep = document.createElement('select');
  selectPrep.setAttribute('name', 'prep[]');
  selectPrep.id = 'tp';

  for (let i = 0; i < $l; i++) {
      let option = document.createElement('option');
      option.innerText = `${data_2[i].name} ${data_2[i].surname} ${data_2[i].patronymic}`;
      option.value = data_2[i].id;
      selectPrep.appendChild(option);
  }

  newElement.appendChild(selectPrep);

  document.getElementById('kr_m').appendChild(newElement);

  count++;
  document.getElementById('t').value = count;

  let button = document.createElement('button');
  button.setAttribute('type', 'button');
  button.id = 'del';

  let img = document.createElement('img');
  img.setAttribute('src', 'pic/x-solid.svg');
  img.setAttribute('alt', '');
  img.setAttribute('width', '56.57px');
  img.setAttribute('height', '56.57px');

  button.appendChild(img);
  newElement.appendChild(button);

  button.addEventListener('click', function() {
    let confirmDelete = confirm("Вы уверены, что хотите удалить этот элемент?");
    if (confirmDelete) {
        newElement.remove();
        count--;
        document.getElementById('t').value = count;
    }
});
}

function validateForm(event) {
  var isValid = true;
  var errorMessage = "";

  // Проверка множественных полей
  validateField("nazv[]", "название");
  validateField("uch_zav[]", "учебное заведение");
  validateField("date_start[]", "дата начала");
  validateField("date_end[]", "дата конца");
  validateField("spec[]", "специальность");
  validateField("kvl[]", "квалификация");
  validateFieldint("kl_c[]", "количество часов");

  // Проверка одиночных полей
  validateSingleFieldLettersOnly("surname", "фамилия");
  validateSingleFieldLettersOnly("name", "имя");
  validateSingleFieldLettersOnly("patronymic", "отчество");
  validateSingleField("DOB", "дата рождения");
  validateSingleField("categorie", "категория");

  if (!isValid) {
    alert(errorMessage);
    event.preventDefault(); // Отменить отправку формы
  }

  function validateField(fieldName, fieldDisplayName) {
    var field = document.getElementsByName(fieldName);
    for (var i = 0; i < field.length; i++) {
      if (field[i].value === "") {
        isValid = false;
        errorMessage += "Пожалуйста, заполните поле '" + fieldDisplayName + "'.\n";
        break;
      }
    }
  }
  function validateFieldint(fieldName, fieldDisplayName) {
    var field = document.getElementsByName(fieldName);
    for (var i = 0; i < field.length; i++) {
      if (field[i].value === "") {
        isValid = false;
        errorMessage += "Пожалуйста, заполните поле '" + fieldDisplayName + "'.\n";
        break;
      }
      else if(isNaN(Number(field[i].value)) === true){
        errorMessage += "Поле '" + fieldDisplayName + "' должно содержать только цифры.\n";
        break;
      }
    }
  }
  function validateSingleField(fieldId, fieldDisplayName) {
    var field = document.getElementById(fieldId);
    if (!field || field.value === "") {
      isValid = false;
      errorMessage += "Пожалуйста, заполните поле '" + fieldDisplayName + "'.\n";
    }
  }

  function validateSingleFieldLettersOnly(fieldId, fieldDisplayName) {
    var field = document.getElementById(fieldId);
    if (!field || field.value === "") {
      isValid = false;
      errorMessage += "Пожалуйста, заполните поле '" + fieldDisplayName + "'.\n";
    } else if (!/^[a-zA-Zа-яА-ЯёЁ]+$/.test(field.value)) {
      isValid = false;
      errorMessage += "Поле '" + fieldDisplayName + "' должно содержать только буквы.\n";
    }
  }
}




function krs_ne() {
  let newElement = document.createElement('div');
  newElement.id = 'krs';

  createInputElement('text', 'nazv[]', 'Вид', "" , newElement);
  createInputElement('text', 'uch_zav[]', 'Учебное заведение', "" , newElement);
  createInputElement('date', 'date_start[]', 'Дата начала', "" , newElement);
  createInputElement('date', 'date_end[]', 'Дата конца', "" , newElement);
  createInputElement('text', 'spec[]', 'Спец', "", newElement);
  createInputElement('text', 'kvl[]', 'Квалификация','', newElement);
  createInputElement('text', 'kl_c[]', 'Кол-во часов','', newElement);
  createInputElement('hidden', 'th', "new" , 'new', newElement);
  createInputElement('hidden', 'type[]', '2' , '2', newElement);

  let input4 = document.createElement('input');
  input4.setAttribute('type', 'hidden');
  input4.setAttribute('name', 'kurs_id[]');
  input4.setAttribute('value', 0);
  newElement.appendChild(input4);

  let button = document.createElement('button');
  button.setAttribute('type', 'button');
  button.id = 'del';

  let img = document.createElement('img');
  img.setAttribute('src', 'pic/x-solid.svg');
  img.setAttribute('alt', '');
  img.setAttribute('width', '56.57px');
  img.setAttribute('height', '56.57px');

  button.appendChild(img);
  newElement.appendChild(button);

  let tab2Element = document.getElementById('tab2'); // Находим элемент по id tab2

  // Проверяем, что элемент с id tab2 найден
  if (tab2Element) {
    let krsNewElement = tab2Element.querySelector('#krs_new'); // Находим элемент с id krs_new внутри tab2

    // Проверяем, что элемент с id krs_new внутри tab2 найден
    if (krsNewElement) {
      krsNewElement.insertAdjacentElement('afterend', newElement); // Вставляем новый элемент после элемента с id krs_new внутри tab2

      count++; // Предполагая, что count - это глобальная переменная
      document.getElementById('t').value = count;

      button.addEventListener('click', function() {
        let confirmDelete = confirm("Вы уверены, что хотите удалить?");
        if (confirmDelete) {
            newElement.remove();
            count--;
            document.getElementById('t').value = count;
        }
      });
    } else {
      // Обработка, если элемент с id krs_new внутри tab2 не найден
      console.error('Элемент с id krs_new внутри tab2 не найден.');
    }
  } else {
    // Обработка, если элемент с id tab2 не найден
    console.error('Элемент с id tab2 не найден.');
  }
}



