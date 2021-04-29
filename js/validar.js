//Validacion del formulario de registro.
function validarRegistro() {
    //---------------------------VARIABLES
    const form = document.getElementById("registroForm");
    const email = document.getElementById("email");
    const nombre = document.getElementById("nombre");
    const dni = document.getElementById("dni");
    const telefono = document.getElementById("telefono");
    const pass = document.getElementById("password");
    const edad = document.getElementById("edad");
    const emailError = document.getElementById("emailError");
    const nombreError = document.getElementById("nombreError");
    const dniError = document.getElementById("dniError");
    const telefonoError = document.getElementById("telefonoError");
    const passError = document.getElementById("passwordError");
    const edadError = document.getElementById("edadError");
    //-----------------------------FORMULARIO SUBMIT
    var correcto;
    form.addEventListener('submit', function(event) {
        if (!nombre.validity.valid) {
            error(nombre);
            event.preventDefault();
        }
        if (!email.validity.valid) {
            error(email);
            event.preventDefault();
        }
        if (!dni.validity.valid) {
            error(dni);
            event.preventDefault();
        }
        if (!telefono.validity.valid) {
            error(telefono);
            event.preventDefault();
        }
        if (!pass.validity.valid) {
            error(pass);
            event.preventDefault();
        }
    });
    nombre.addEventListener('blur', function(event) {
        if (nombre.validity.valid) {
            nombreError.className = 'valid-feedback';
            nombre.classList.add('is-valid');
            nombre.classList.remove('is-invalid');
            nombreError.textContent = '';
        } else {
            error(nombre);
        }
    });
    email.addEventListener('blur', function(event) {
        if (email.validity.valid) {
            emailError.className = 'valid-feedback';
            email.classList.add('is-valid');
            email.classList.remove('is-invalid');
            emailError.textContent = '';
        } else {
            error(email);
        }
    });
    dni.addEventListener('blur', function(event) {
        if (dni.validity.valid) {
            dniError.className = 'valid-feedback';
            dni.classList.add('is-valid');
            dni.classList.remove('is-invalid');
            dniError.textContent = '';
        } else {
            error(dni);
        }
    });
    pass.addEventListener('blur', function(event) {
        if (pass.validity.valid) {
            passError.className = 'valid-feedback';
            pass.classList.add('is-valid');
            pass.classList.remove('is-invalid');
            passError.textContent = '';
        } else {
            error(pass);
        }
    });
    telefono.addEventListener('blur', function(event) {
        if (telefono.validity.valid) {
            telefonoError.className = 'valid-feedback';
            telefono.classList.add('is-valid');
            telefono.classList.remove('is-invalid');
            telefonoError.textContent = '';
        } else {
            error(telefono);
        }
    });

    edad.addEventListener('blur', function(event) {
        if (edad.validity.valid) {
            edadError.className = 'valid-feedback';
            edad.classList.add('is-valid');
            edad.classList.remove('is-invalid');
            edadError.textContent = '';
        } else {
            error(edad);
        }
    });

    function error(campo) {
        if (campo == nombre) {
            //Campo vacío
            if (nombre.validity.valueMissing) {
                nombreError.textContent = 'Debe introducir su nombre.';
            } else if (nombre.validity.tooShort) {
                nombreError.textContent = 'Debe tener al menos ' + nombre.minLength + ' caracteres; ha introducido ' + nombre.value.length;
            } else if (nombre.validity.tooLong) {
                nombreError.textContent = 'Debe tener como máximo ' + nombre.maxLength + ' caracteres; ha introducido ' + nombre.value.length;
            }
            // Establece el estilo apropiado
            nombre.classList.remove('is-valid');
            nombre.classList.add('is-invalid');
            nombreError.className = 'invalid-feedback';
        }
        if (campo == email) {
            //Campo vacío
            if (email.validity.valueMissing) {
                emailError.textContent = 'Debe introducir su dirección de correo electrónico.';
                //No cumple los requisitos del campo email
            } else if (email.validity.typeMismatch) {
                emailError.textContent = 'El valor introducido debe ser una dirección de correo electrónico ';
                //Datos demasiado cortos
            }
            // Establece el estilo apropiado
            email.classList.remove('is-valid');
            email.classList.add('is-invalid');
            emailError.className = 'invalid-feedback';
        }
        if (campo == dni) {
            //Campo vacío
            if (dni.validity.valueMissing) {
                dniError.textContent = 'Debe introducir su dni.';
                //No cumple con el pattern
            } else if (dni.validity.patternMismatch) {
                dniError.textContent = 'El valor introducido debe seguir este patron 00000000X';
            }
            // Establece el estilo apropiado
            dni.classList.remove('is-valid');
            dni.classList.add('is-invalid');
            dniError.className = 'invalid-feedback';
        }
        if (campo == telefono) {
            if (telefono.validity.valueMissing) {
                telefonoError.textContent = 'Debe introducir su teléfono.';
            } else if (telefono.validity.patternMismatch) {
                telefonoError.textContent = 'El valor introducido debe ser un numero de telefono de 9 digitos.';
            }
            // Establece el estilo apropiado
            telefono.classList.remove('is-valid');
            telefono.classList.add('is-invalid');
            telefonoError.className = 'invalid-feedback';
        }
        if (campo == pass) {
            //Campo vacío
            if (pass.validity.valueMissing) {
                passError.textContent = 'Debe introducir una contraseña.';
                //Dato demasiado cortos
            } else if (pass.validity.tooShort) {
                passError.textContent = 'Debe tener al menos ' + pass.minLength + ' caracteres; ha introducido ' + pass.value.length;
            }
            // Establece el estilo apropiado
            pass.classList.remove('is-valid');
            pass.classList.add('is-invalid');
            passError.className = 'invalid-feedback';
        }
        if (campo == edad) {
            //Campo vacío
            if (edad.validity.valueMissing) {
                edadError.textContent = 'Debe introducir una edad.';
                //Dato demasiado cortos
            }
            // Establece el estilo apropiado
            edad.classList.remove('is-valid');
            edad.classList.add('is-invalid');
            edadError.className = 'invalid-feedback';
        }
    }

}

//Validacion formulario login
function validacionLogin() {
    //Obtenemos formulario.
    const form = document.getElementById("loginForm");
    //Obtencion del campo email y su campo de error.
    const email = document.getElementById("emailLogin");
    const emailError = document.getElementById("emailError");
    // Obtencion del campo password y su campo error.
    const password = document.getElementById("passwordLogin");
    const passwordError = document.getElementById("passwordError");

    //Control de validacion en evento submit para el envio de formulario.
    form.addEventListener('submit', function(event) {
        if (!email.validity.valid) {
            error(email);
            event.preventDefault();
        }
        if (!password.validity.valid) {
            error(password);
            event.preventDefault();
        }
    });

    //Control de validacion en evento blur para cuando cambiamos el focus del input nos valide el campo.
    email.addEventListener('blur', function(event) {
        if (email.validity.valid) {
            emailError.className = 'valid-feedback';
            email.classList.remove('is-invalid');
            email.classList.add('is-valid');
            emailError.textContent = '';
        } else {
            error(email);
        }
    });
    password.addEventListener('blur', function(event) {
        if (password.validity.valid) {
            passwordError.className = 'valid-feedback';
            password.classList.remove('is-invalid');
            password.classList.add('is-valid');
            passwordError.textContent = '';
        } else {
            error(password);
        }
    });
    // fucnion para gestion de error por parametro del campo que genera el error en formulario
    function error(campo) {
        if (campo == email) {
            //Campo vacío
            if (email.validity.valueMissing) {
                emailError.textContent = 'Debe introducir su dirección de correo electrónico.';
                //No cumple los requisitos del campo email
            } else if (email.validity.typeMismatch) {
                emailError.textContent = 'El valor introducido debe ser una dirección de correo electrónico ';
                //Datos demasiado cortos
            }
            // Establece el estilo apropiado
            email.classList.remove('is-valid');
            email.classList.add('is-invalid');
            emailError.className = 'invalid-feedback';
        }
        if (campo == password) {
            //Campo vacío
            if (password.validity.valueMissing) {
                passwordError.textContent = 'Debe introducir una contraseña.';
                //Dato demasiado cortos
            } else if (password.validity.tooShort) {
                passwordError.textContent = 'Debe tener al menos ' + password.minLength + ' caracteres; ha introducido ' + password.value.length;
                //Dato demasiado largo
            }
            // Establece el estilo apropiado
            password.classList.remove('is-valid');
            password.classList.add('is-invalid');
            passwordError.className = 'invalid-feedback';
        }
    }
}

//---------------------------Validacion de cambio de contraseña
function validarCambio() {
    const form = document.getElementById("olvidada");
    const email = document.getElementById("email");
    const emailError = document.getElementById("emailError");
    //-----------------------------FORMULARIO SUBMIT
    var correcto;
    form.addEventListener('submit', function(event) {
        if (!email.validity.valid) {
            error(email);
            event.preventDefault();
        }

    });

    email.addEventListener('blur', function(event) {
        if (email.validity.valid) {
            emailError.className = 'valid-feedback';
            email.classList.add('is-valid');
            email.classList.remove('is-invalid');
            emailError.textContent = '';
        } else {
            error(email);
        }
    });

    function error(campo) {
        if (campo == email) {
            //Campo vacío
            if (email.validity.valueMissing) {
                emailError.textContent = 'Debe introducir su dirección de correo electrónico.';
                //No cumple los requisitos del campo email
            } else if (email.validity.typeMismatch) {
                emailError.textContent = 'El valor introducido debe ser una dirección de correo electrónico ';
                //Datos demasiado cortos
            }
            // Establece el estilo apropiado
            email.classList.remove('is-valid');
            email.classList.add('is-invalid');
            emailError.className = 'invalid-feedback';
        }
    }
}