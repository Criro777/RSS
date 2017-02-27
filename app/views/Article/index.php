<div class="container">
    <div style="height: 300px;" class="panel panel-default">

        <div class="panel-heading">
            <h5>Загрузка RSS-ленты</h5>
        </div>
        <div class="panel-body">
            <button style="margin-top: 15px; width:180px; margin-left:39%; align: center" id="content" type="submit"
                    class="btn btn-success" name="Submit">Загрузить RSS-ленту
            </button>

        </div>
        <div style="width: 400px; height: 50px;margin-left: 30%;" id="msgSubmit" class="alert alert-success ">
            <h3 style="text-align: center; margin-top: -30px;"><br> Данные успешно загружены</h3>
        </div>
        <form action="/article/list/" method="post" id="view">
            <button style="margin-top: 15px; width:250px; margin-left:36%; align: center" type="submit"
                    class="btn btn-success" name="Submit">Посмотреть
            </button>
        </form>
    </div>
    
</div>
