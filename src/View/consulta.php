  <!DOCTYPE html>
  <html>
    <head>

      <link type="text/css" rel="stylesheet" href="style.css"  media="screen,projection"/>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <style>
          <?php include 'style.css';  ?>
      </style>
    </head>

    <body>

        <div class="containerclear">
            <div class="containerbox">
                <div class="box1">
                    <form >
                        <label for="fname">Digite o nome do produto</label>
                        <input type="text" id="pesquisa" name="pesquisa" placeholder="Digite seu Usuario">
           
                      
                        <input type="button" value="PESQUISAR" id="consultar">
                    </form>
                </div>
      
            </div>
        </div>
        <div class="container" id="containerTable">

            <table id="produtos">
                <tr>
                  <th>Nome do produto</th>
                  <th>Preço</th>
                  <th>Ultima alteração</th>
                </tr>

              </table>
        </div>

        <div id="myModal" class="modal">
            <div class="modal-content">
              
                <p>Informe um token</p>
                <input type="text" id="token" name="token" placeholder="Digite um token">
                <input type="submit" value="Verificar" id="validar">
            </div>
        </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>

        $(document).ready(function (){

            $.ajax({
              url: "/validaSessao",
              dataType: "json"
            }).done(function(data) {
                console.log(data);
                if(data.error){
                   $("#myModal").css("display","block");
                }
            });
            
            $("#containerTable").hide();
            $("#validar").click(function(e){

                  $.ajax({
                      url : "/verificaToken",
                      type : 'post',
                      data : {
                        token : $("#token").val(),
                      },
                      dataType: "json"
                  }).done(function(data){
                        if(!data.error){
                            $("#myModal").css("display","none");
                            $("token").val("");
                        }else{
                          alert(data.mensagem);
                        }
                      
                  }).fail(function(e){
                      console.log(e);
                  });

            });

            $("#myBtn").click(function(e){
                $("#myModal").css("display","block");
            });

            $(".close").click(function(e){
                $("#myModal").css("display","none");
                $("token").val("");
            });
            $("#consultar").click(function(){
                    $("#containerTable").hide();
                    let campo = $("#pesquisa").val();
                    $.ajax({
                        url : "/api/produtos",
                        type : 'GET',
                        data : {nome :campo},
                        dataType: "json"
                    }).done(function(data){
                        console.log(data);
                          $("#produtos td").remove();
                          if(!data.error){
                              let dados = data.dados;
                              if(dados.length < 1 ){
                                alert("Produto não encontrado!"); 
                                return 0;
                              } 
                              for(let y in dados){
                                let data = new Date(dados[y].ultimaAtualizacao);
                                $('#produtos')
                                .append(`
                                        <tr>
                                            <td>${dados[y].nome}</td>
                                            <td>R$${dados[y].preco}</td>
                                            <td>${data.getMonth()+1}/${data.getDate()}/${data.getFullYear()} ${data.getHours()}:${data.getMinutes()}</td>
                                        </tr>`);
                              }
                              $("#containerTable").show();
                          }else{
                            alert(data.mensagem);
                          }

                    }).fail(function(e){
                        alert("Erro ao realizar consulta");
                    });
            });


        });

    </script>
    </body>


  </html>