<div id="main-content" class="clearfix">
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="home">Home</a>

                <span class="divider">
                    <i class="icon-angle-right"></i>
                </span>
            </li>
            <li class="active">Add City</li>
        </ul><!--.breadcrumb-->

        <div id="nav-search">
            <form class="form-search">
                <span class="input-icon">
                    <input type="text" placeholder="Search ..." class="input-small search-query" id="nav-search-input" autocomplete="off" />
                    <i class="icon-search" id="nav-search-icon"></i>
                </span>
            </form>
        </div><!--#nav-search-->
    </div>
    <div id="page-content" class="clearfix">
        <div class="page-header position-relative">
            <h1>
                Create New City
            </h1>
        </div><!--/.page-header-->
        <form class="form-horizontal">
            <br />
            <div class="control-group">
                <label class="control-label" for="form-field-1">Country</label>

                <div class="controls">
                    <select id="form-field-select-1">
                        <option value=""></option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                    </select>
                </div>
            </div>


            <div class="control-group">
                <label class="control-label" for="form-field-1">Name</label>

                <div class="controls">
                    <input type="text" id="name" placeholder="Enter City Name" />
                </div>
            </div>
<br />
<br />
            <div class="form-actions">
                <button class="btn btn-info" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Submit
                </button>

                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                    <i class="icon-undo bigger-110"></i>
                    Reset
                </button>
            </div>

        </form>
    </div>
</div>