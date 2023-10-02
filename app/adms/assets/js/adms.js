

//PERMITIR RETORNO NO NAVEGDOR QUANDO ESTIVER EM UM FORMULARIO APOS UM ERRO
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

// Calcular a forca da senha
function passwordStrength() {
  var password = document.getElementById("password").value;
  var strength = 0;

  if (password.length >= 6 && password.length <= 7) {
    strength += 10;
  } else if (password.length > 7) {
    strength += 25;
  }

  if (password.length >= 6 && password.match(/[a-z]+/)) {
    strength += 10;
  }

  if (password.length >= 7 && password.match(/[A-Z]+/)) {
    strength += 20;
  }

  if (password.length >= 8 && password.match(/[@#$%;*]+/)) {
    strength += 25;
  }
  console.log(strength);
  if (password.match(/([1-9]+)\1{1,}/)) {
    strength -= 25;
  }
  viewStrength(strength);
}

function viewStrength(strength) {
  // Imprimir a força da senha
  if (strength < 30) {
    document.getElementById("msgViewStrength").innerHTML =
      "<p style='color: #f00;'>Senha Fraca</p>";
  } else if (strength >= 30 && strength < 50) {
    document.getElementById("msgViewStrength").innerHTML =
      "<p style='color: #ff8c00;'>Senha Média</p>";
  } else if (strength >= 50 && strength < 69) {
    document.getElementById("msgViewStrength").innerHTML =
      "<p style='color: #7cfc00;'>Senha Boa</p>";
  } else if (strength >= 70) {
    document.getElementById("msgViewStrength").innerHTML =
      "<p style='color: #008000;'>Senha Forte</p>";
  } else {
    document.getElementById("msgViewStrength").innerHTML = "";
  }
}

//VALIDAÇÃO DO FORMULARIO DE CADASTRO DE USUÁRIO
const formNewUser = document.getElementById("form-new-nser");
if (formNewUser) {
  formNewUser.addEventListener("submit", async (e) => {
    //Receber o valor do campo
    var name = document.querySelector("#name").value;
    // Verificar se o campo esta vazio
    if (name === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo nome!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    //Receber o valor do campo
    var email = document.querySelector("#email").value;
    // Verificar se o campo esta vazio
    if (email === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo e-mail!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    //Receber o valor do campo
    var password = document.querySelector("#password").value;
    // Verificar se o campo esta vazio
    if (password === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo senha!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    // Verificar se o campo senha possui 6 caracteres
    if (password.length < 6) {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: A senha deve ter no mínimo 6 caracteres!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    // Verificar se o campo senha não possui números repetidos
    if (password.match(/([1-9]+)\1{1,}/)) {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: A senha não deve ter número repetido!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    // Verificar se o campo senha possui letras
    if (!password.match(/[A-Za-z]/)) {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: A senha deve ter pelo menos uma letra!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
  });
}

//VALIDAÇÃO DO FORMULARIO LOGIN
const formLogin = document.getElementById("form-login");
if (formLogin) {
  formLogin.addEventListener("submit", async (e) => {
    //Receber o valor do campo
    var user = document.querySelector("#user").value;
    // Verificar se o campo esta vazio
    if (user === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o usuário!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    //Receber o valor do campo
    var password = document.querySelector("#password").value;
    // Verificar se o campo esta vazio
    if (password === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo senha!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
  });
}

//VALIDAÇÃO DO FORMULARIO NEW-CONF-EMAIL
const formNewConfEmail = document.getElementById("form-new-conf-email");
if (formNewConfEmail) {
  formNewConfEmail.addEventListener("submit", async (e) => {
    //Receber o valor do campo
    var email = document.querySelector("#email").value;
    // Verificar se o campo esta vazio
    if (email === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo email!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
  });
}

//VALIDAÇÃO DO FORMULARIO EDITAR SENHA
const formeditPass = document.getElementById("form-editPass");
if (formeditPass) {
  formeditPass.addEventListener("submit", async (e) => {
    //Receber o valor do campo senha
    var passwordEdit = document.querySelector("#password").value;
    // Verificar se o campo esta vazio
    if (passwordEdit === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo senha!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    // Verificar se o campo senha possui 6 caracteres
    if (passwordEdit.length < 6) {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: A senha deve ter no mínimo 6 caracteres!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    // Verificar se o campo senha não possui números repetidos
    if (passwordEdit.match(/([1-9]+)\1{1,}/)) {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: A senha não deve ter número repetido!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    // Verificar se o campo senha possui letras
    if (!passwordEdit.match(/[A-Za-z]/)) {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: A senha deve ter pelo menos uma letra!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
  });
}

//VALIDAR FORMULÁRIO DE RECUPERAÇÃO DE SENHA
const formRecoverPass = document.getElementById("form-recover-pass");
if (formRecoverPass) {
  formRecoverPass.addEventListener("submit", async (e) => {
    //Receber o valor do campo
    var email = document.querySelector("#email").value;
    // Verificar se o campo esta vazio
    if (email === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo email!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
  });
}

//VALIDAR FORMULÁRIO DE atualização de senha
const formUpdatePass = document.getElementById("form-update-pass");
if (formUpdatePass) {
  formUpdatePass.addEventListener("submit", async (e) => {
    //Receber o valor do campo senha
    var passwordEdit = document.querySelector("#password").value;
    // Verificar se o campo esta vazio
    if (passwordEdit === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo senha!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    // Verificar se o campo senha possui 6 caracteres
    if (passwordEdit.length < 6) {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: A senha deve ter no mínimo 6 caracteres!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    // Verificar se o campo senha não possui números repetidos
    if (passwordEdit.match(/([1-9]+)\1{1,}/)) {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: A senha não deve ter número repetido!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    // Verificar se o campo senha possui letras
    if (!passwordEdit.match(/[A-Za-z]/)) {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: A senha deve ter pelo menos uma letra!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
  });
}
//VALIDAR FORMULÁRIO DE EDITAR SENHA DO PERFIL
const formPrpfilePass = document.getElementById("formeditProfilePass");
if (formPrpfilePass) {
  formPrpfilePass.addEventListener("submit", async (e) => {
    //Receber o valor do campo senha
    var passwordEdit = document.querySelector("#password").value;
    // Verificar se o campo esta vazio
    if (passwordEdit === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo senha!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    // Verificar se o campo senha possui 6 caracteres
    if (passwordEdit.length < 6) {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: A senha deve ter no mínimo 6 caracteres!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    // Verificar se o campo senha não possui números repetidos
    if (passwordEdit.match(/([1-9]+)\1{1,}/)) {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: A senha não deve ter número repetido!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    // Verificar se o campo senha possui letras
    if (!passwordEdit.match(/[A-Za-z]/)) {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: A senha deve ter pelo menos uma letra!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
  });
}

//VALIDAR FORMULÁRIO DE IMAGEM
const formImg = document.getElementById("form-edit-img");
if (formImg) {
  formImg.addEventListener("submit", async (e) => {
    //Receber o valor do campo
    var new_image = document.querySelector("#new_image").value;
    // Verificar se o campo esta vazio
    if (new_image === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário selecionar a imagem!!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
  });
}

//VALIDAR FORMULÁRIO ADICIONAR/EDITAR SITUAÇÃOS NO BANCO
const formAddSits = document.getElementById("form-add-Edit-Sit");
if (formAddSits) {
  formAddSits.addEventListener("submit", async (e) => {
    //Receber o valor do campo nome
    var name = document.querySelector("#name").value;
    if (name === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário Prencher o Campo Nome!</p>";
      return;
    }else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    //Receber o valor do campo select
    var adms_color_id = document.querySelector("#adms_color_id").value;
    if (adms_color_id === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário selecionar uma opsão!</p>";
      return;
    }else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
  });
}



//VALIDAÇÃO DO FORMULARIO DE CADASTRO NOVO USUÁRIO
const formAddUser = document.getElementById("form-addUser");
if (formAddUser) {
  formAddUser.addEventListener("submit", async (e) => {
    //Receber o valor do campo nome
    var name = document.querySelector("#name").value;
    // Verificar se o campo esta vazio
    if (name === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo nome!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    //Receber o valor do campo usuario
    var user = document.querySelector("#user").value;
    // Verificar se o campo esta vazio
    if (user === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo usuário!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    //Receber o valor do campo email
    var email = document.querySelector("#email").value;
    // Verificar se o campo esta vazio
    if (email === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo e-mail!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }

    //Receber o valor do campo select
    var adms_sits_user_id = document.querySelector("#adms_sits_user_id").value;
    // Verificar se o campo esta vazio
    if (adms_sits_user_id === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário selecionar uma opsão no campo select!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    //Receber o valor do campo senha
    var password = document.querySelector("#password").value;
    // Verificar se o campo esta vazio
    if (password === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo senha!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    // Verificar se o campo senha possui 6 caracteres
    if (password.length < 6) {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: A senha deve ter no mínimo 6 caracteres!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    // Verificar se o campo senha não possui números repetidos
    if (password.match(/([1-9]+)\1{1,}/)) {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: A senha não deve ter número repetido!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    // Verificar se o campo senha possui letras
    if (!password.match(/[A-Za-z]/)) {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: A senha deve ter pelo menos uma letra!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
  });
}


// VALIDAÇÃO DO FORMULARIO EDITAR
const formEditUser = document.getElementById("form-editUser");
if (formEditUser) {
  formEditUser.addEventListener("submit", async (e) => {
    //Receber o valor do campo
    var name = document.querySelector("#name").value;
    // Verificar se o campo esta vazio
    if (name === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo nome!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    //Receber o valor do campo
    var user = document.querySelector("#user").value;
    // Verificar se o campo esta vazio
    if (user === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo usuário!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    //Receber o valor do campo email
    var email = document.querySelector("#email").value;
    // Verificar se o campo esta vazio
    if (email === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo e-mail!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    //Receber o valor do campo select
    var adms_sits_user_id = document.querySelector("#adms_sits_user_id").value;
    // Verificar se o campo esta vazio
    if (adms_sits_user_id === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário selecionar uma opsão no campo select!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
  });
}
//FORMULARIO EDITAR PERFIL
const formEditProfili = document.getElementById("form-editProfile");
if (formEditProfili) {
  formEditProfili.addEventListener("submit", async (e) => {
    //Receber o valor do campo
    var name = document.querySelector("#name").value;
    // Verificar se o campo esta vazio
    if (name === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo nome!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    //Receber o valor do campo
    var user = document.querySelector("#user").value;
    // Verificar se o campo esta vazio
    if (user === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo usuário!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
    //Receber o valor do campo email
    var email = document.querySelector("#email").value;
    // Verificar se o campo esta vazio
    if (email === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário preencher o campo e-mail!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
  });
}
//VALIDAR FORMULÁRIO DE EDITPROFILEIMG
const formEditProfileimg = document.getElementById("formEditProfileimg");
if (formEditProfileimg) {
  formEditProfileimg.addEventListener("submit", async (e) => {
    //Receber o valor do campo email
    var new_image = document.querySelector("#new_image").value;
    // Verificar se o campo esta vazio
    if (new_image === "") {
      e.preventDefault();
      document.getElementById("msg").innerHTML =
        "<p style='color: #f00;'>Erro: Necessário Selecionar uma Imagem!!!</p>";
      return;
    } else {
      document.getElementById("msg").innerHTML = "<p></p>";
    }
  });
}
//VALIDAR EXTENSÃO DA IMAGEM
function inputFileImg() {
  var new_image = document.querySelector("#new_image");
  var filePath = new_image.value;
  var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/;
  if (!allowedExtensions.exec(filePath)) {
    new_image.value = "";
    document.getElementById("msg").innerHTML =
      "<p style='color: #f00;'>Erro: Necessário Selecionar uma Imagem. Jpg/Png!!!</p>";
    return;
  } else {
    previewImage(new_image);
    document.getElementById("msg").innerHTML = "<p></p>";
  }
}
function previewImage(new_image) {
  if (new_image.files && new_image.files[0]) {
    //FileReder(), função usada para ler o conteudo do arquivo
    var reader = new FileReader();
    //onload - disparador de evento quando qualquer elemente tenha sido carregado
    reader.onload = function (e) {
      document.getElementById("preview-img").innerHTML =
        "<img src='" + e.target.result + "' alt='Imagem' style='width:100px;'>";
    };
  }
  //readAsDataURL() - retorna os dados do formato blob como uma url de dados - blob representa um arquivo
  reader.readAsDataURL(new_image.files[0]);
}

//VALIDAR FORMULÁRIO ADICIONAR  SITUAÇÃOS NO BANCO
const formEditSitUser = document.getElementById("form-add-sit-user");
if (formEditSitUser) {
    formEditSitUser.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        //Receber o valor do campo
        var adms_color_id = document.querySelector("#adms_color_id").value;
        // Verificar se o campo esta vazio
        if (adms_color_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo Cor!</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}

//VALIDAR FORMULÁRIO ADICIONAR COR NO BANCO
const formAddColors = document.getElementById("form-add-color");
if (formAddColors) {
    formAddColors.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        //Receber o valor do campo
        var color = document.querySelector("#color").value;
        // Verificar se o campo esta vazio
        if (color === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo cor!</p>";
            return;
        }
    });
}
//FORMLÁRIO TABELA EMAIL CADASTRADO,  ADD EMAIL
const formAddConfEmails = document.getElementById("form-add-conf-emails");
if (formAddConfEmails) {
    formAddConfEmails.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var title = document.querySelector("#title").value;
        // Verificar se o campo esta vazio
        if (title === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo titulo!</p>";
            return;
        }

        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }
        
        var email = document.querySelector("#email").value;
        // Verificar se o campo esta vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo email!</p>";
            return;
        }

        var host = document.querySelector("#host").value;
        // Verificar se o campo esta vazio
        if (host === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo host!</p>";
            return;
        }

        var username = document.querySelector("#username").value;
        // Verificar se o campo esta vazio
        if (username === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo usuário!</p>";
            return;
        }

        var password = document.querySelector("#password").value;
        // Verificar se o campo esta vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo senha!</p>";
            return;
        }

        var smtpsecure = document.querySelector("#smtpsecure").value;
        // Verificar se o campo esta vazio
        if (smtpsecure === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo smtp!</p>";
            return;
        }

        var port = document.querySelector("#port").value;
        // Verificar se o campo esta vazio
        if (port === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo porta!</p>";
            return;
        }
    });
}

//FORMLÁRIO TABELA EMAIL CADASTRADO EDITAR CONFIRMA EMAIL
const formEditConfEmails = document.getElementById("form-edit-conf-emails");
if (formEditConfEmails) {
    formEditConfEmails.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var title = document.querySelector("#title").value;
        // Verificar se o campo esta vazio
        if (title === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo titulo!</p>";
            return;
        }

        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }
        
        var email = document.querySelector("#email").value;
        // Verificar se o campo esta vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo email!</p>";
            return;
        }

        var host = document.querySelector("#host").value;
        // Verificar se o campo esta vazio
        if (host === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo host!</p>";
            return;
        }

        var username = document.querySelector("#username").value;
        // Verificar se o campo esta vazio
        if (username === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo usuário!</p>";
            return;
        }

        var smtpsecure = document.querySelector("#smtpsecure").value;
        // Verificar se o campo esta vazio
        if (smtpsecure === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo smtp!</p>";
            return;
        }

        var port = document.querySelector("#port").value;
        // Verificar se o campo esta vazio
        if (port === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo porta!</p>";
            return;
        }
    });
}
//FORMLÁRIO TABELA EMAIL CADASTRADO EDITAR CONFIRMA SENHA EMAIL
const formEditConfEmailsPass = document.getElementById("form-edit-conf-emails-pass");
if (formEditConfEmailsPass) {
    formEditConfEmailsPass.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var password = document.querySelector("#password").value;
        // Verificar se o campo esta vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo senha!</p>";
            return;
        }
    });
}

//MENU

let notificacao = document.querySelector(".notificacao");
let avatar =document.querySelector(".avatar");
dropMenu(avatar)
dropMenu(notificacao)
function dropMenu(selector){
    selector.addEventListener("click", ()=>{
        
       // let dropDownMenu = selector.querySelector(".dropdow-menu");
       // dropDownMenu.classList.contains("active")? dropDownMenu.classList.remove("active"): 
       // dropDownMenu.classList.add("active")
        let dropDownMenu = selector.querySelector(".dropdow-menu");
        dropDownMenu.classList.toggle("active");
    })

}

//INICIO DROPDOWN BOTAO AÇÕES
function actionDropdown(id){ 
     closeDropDownAction();
    document.getElementById("actionDropdown"+ id).classList.toggle("show-dropdown-action");
}

window.onclick = function(event){
    if(!event.target.matches(".dropdown-btn-action")){
      // document.getElementById("actionDropdown").classList.remove("show-dropdown-action")//
      closeDropDownAction();
  }
}
function closeDropDownAction(){
    var dropDawns = document.getElementsByClassName("dropdown-action-item");
    var i;
    for(i=0; i<dropDawns.length; i++){
        var openDropdown  = dropDawns[i];
        if(openDropdown.classList.contains("show-dropdown-action")){
            openDropdown.classList.remove("show-dropdown-action");
        }
    }
} 



//inicio dropdown sidebar
var dropdownSidebar = document.getElementsByClassName("dropdown-btn");
var i;
for(i=0; i<dropdownSidebar.length; i++){
    dropdownSidebar[i].addEventListener("click", function(){
        this.classList.toggle("active");

        var dropdownContent = this.nextElementSibling;
        if(dropdownContent.style.display === "block"){
            dropdownContent.style.display = "none";
        }else{
            dropdownContent.style.display = "block"; 
        }
    } );
}

//fim dropdown sidebar

