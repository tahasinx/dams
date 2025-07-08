<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <input id="myInput" list="id" placeholder="Search....">
        <datalist id="id">
            <option value="category@123">Blood Test</option>
            <option value="category@123456">Harmon Test</option>
        </datalist>
        <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog modal-lg" style="width: 500px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4><b>CATEGORY DESCRIPTION</b></h4><button type="button" class="close" data-dismiss="modal" style="color:red">×</button>
                    </div>
                    <div class="modal-body">
                        Most blood tests only take a few minutes to complete and are carried out at your GP surgery or local hospital by a doctor, nurse or phlebotomist (a specialist in taking blood samples).                                                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div><div class="modal fade" id="myModal4" role="dialog">
            <div class="modal-dialog modal-lg" style="width: 500px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4><b>CATEGORY DESCRIPTION</b></h4><button type="button" class="close" data-dismiss="modal" style="color:red">×</button>
                    </div>
                    <div class="modal-body">
                        adasdasdsad asdsa ada ad asdas as adasdas                                                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div><table class="table">
            <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Category Name</th>
                    <th>Category ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <tr>
            <form method="POST" action=""></form>
            <td>1</td>
            <td><input name="category_name" value="Blood Test"></td>
            <td><input name="category_id" value="category@123"></td>
            <td>
                <span class="btn btn-success" data-toggle="modal" data-target="#myModal2"><i class="fa fa-book"></i></span>

                <input name="status" type="hidden" value="0">
                ||<button class="btn btn-primary" type="submit" name="update"><i class="fa fa-check"></i></button>
                ||<button class="btn btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></button>

            </td>

            </tr>

            <tr>
            <form method="POST" action=""></form>
            <td>3</td>
            <td><input name="category_name" value="Harmon Test"></td>
            <td><input name="category_id" value="category@123456"></td>
            <td>
                <span class="btn btn-success" data-toggle="modal" data-target="#myModal4"><i class="fa fa-book"></i></span>

                <input name="status" type="hidden" value="0">
                ||<button class="btn btn-primary" type="submit" name="update"><i class="fa fa-check"></i></button>
                ||<button class="btn btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></button>

            </td>

            </tr>

            </tbody>
        </table>
    </div>
    <div class="col-sm-2"></div>
</div>