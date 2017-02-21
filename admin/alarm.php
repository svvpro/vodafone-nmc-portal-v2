<?php include("partials/admin/head.php"); ?>
    <div class="container">
        <?php include("partials/admin/menu.php"); ?>
        <h2>Редактор шаблонов</h2>
        <div id="type" ng-controller="AlarmCtrl" ng-cloak >
            <div class="row">
                <div class="col-md-12">
                    <form  ng-init="add=true" class="well" >
                        <input type="hidden" ng-model="id" >

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" ng-init="select_system()">
                                    <label for="inputSystem"> Система</label>
                                    <select class="form-control" name="repeatSelect" ng-model="system_id">
                                        <option  ng-repeat="system in systemItems" value="{{ system.id }}">{{ system.title}}</option>
                                    </select>
                                    <span ng-show="!system_id" class="label label-danger" >Поле обязательно к заполенинию</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" ng-init="select_type_template()">
                                    <label for="inputSystem"> Тип шаблона</label>
                                    <select class="form-control" name="repeatSelect" ng-model="type_id">
                                        <option  ng-repeat="type_template in typeTemplateItems" value="{{ type_template.id }}">{{ type_template.title}}</option>
                                    </select>
                                    <span ng-show="!type_id" class="label label-danger" >Поле обязательно к заполенинию</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" ng-init="select_type_agree()">
                                    <label for="inputSystem"> Тип согласования шаблона</label>
                                    <select class="form-control" name="repeatSelect" ng-model="type_agree_id">
                                        <option  ng-repeat="type_agree in typeArgeeItems" value="{{ type_agree.id }}">{{ type_agree.title}}</option>
                                    </select>
                                    <span ng-show="!type_agree_id" class="label label-danger" >Поле обязательно к заполенинию</span>
                                </div>
                            </div>
                        </div>

                        <label for="inputText">Текст</label>
                        <textarea class="form-control" name="" ng-model="text" id=""  rows="10"></textarea>
                        <span ng-show="!text" class="label label-danger" >Поле обязательно к заполенинию</span>
                        <br>
                        <button ng-show='add'  ng-disabled="!type_id || !system_id || !text || !type_agree_id" ng-click = "submit_alarm()" type="submit" class="btn btn-primary full-width">Добавить</button>
                        <button ng-show='update' ng-disabled="!type_id || !system_id || !text || !type_agree_id" ng-click = "update_alarm()" type="submit" class="btn btn-warning full-width button_margin_bottom">Обновить</button>
                        <button ng-show='add_new' ng-click = "new_item()" type="submit" class="btn btn-primary full-width">Cоздать новую запись</button>
                    </form>
                </div>
            </div>
            <hr>
            <h2>Поиск шаблона</h2>
            <div class="row">
                <div class="col-md-12">
                    <form class="well">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" ng-init="select_system()">
                                <label for="inputSystem"> Выборка по системам</label>
                                <select class="form-control" name="repeatSelect" ng-model="system.title">
                                    <option value="{{ }}">All</option>
                                    <option  ng-repeat="system in systemItems" value="{{ system.title }}">{{ system.title}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" ng-init="select_type_template()">
                                <label for="inputSystem"> Выборка по типам шаблона</label>
                                <select class="form-control" name="repeatSelect" ng-model="typeTemplate.title">
                                    <option value="{{ }}">All</option>
                                    <option  ng-repeat="typeTemplate in typeTemplateItems" value="{{ typeTemplate.title }}">{{ typeTemplate.title}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" ng-init="select_type_agree()">
                                <label for="inputSystem"> Выборка по типам согласования</label>
                                <select class="form-control" name="repeatSelect" ng-model="typeAgree.title">
                                    <option value="{{ }}">All</option>
                                    <option  ng-repeat="typeAgree in typeArgeeItems" value="{{ typeAgree.title }}">{{ typeAgree.title}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="text">Поиск по шаблонам:</label>
                                <input type="text" class="form-control" id="focusedInput" ng-model="query">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-hover" ng-init="get_alarm()">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Система</th>
                                    <th>Тип шаблона</th>
                                    <th>Тип согласования</th>
                                    <th>Текст</th>
                                </tr>
                                </thead>
                                <tbody >
                                <tr dir-paginate = "alarm in pageItems | orderBy:'-id' | filter:{text:query, system: system.title, type: typeTemplate.title, type_agree: typeAgree.title  } | itemsPerPage: 10" >
                                    <td>{{ alarm.id }} </td>
                                    <td>{{ alarm.system }} </td>
                                    <td style="min-width: 120px">{{ alarm.type }} </td>
                                    <td style="min-width: 150px">{{ alarm.type_agree }} </td>
                                    <td  class="text">{{ alarm.text }}</td>
                                    <td class="pull-right" style="min-width: 230px">
                                        <a href="" ng-click="edit_alarm(alarm.id)" class="btn btn-warning"> Редактировать</a>
                                        <a href="" ng-click="delete_alarm(alarm.id)" class="btn btn-danger"> Удалить</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <dir-pagination-controls template-url="bower_components/angularUtils-pagination/dirPagination.tpl.html"></dir-pagination-controls>
                            </div>
                        </div>
                    </div>

        </div>
    </div>
<?php include("partials/admin/bottom.php"); ?>