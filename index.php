    
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Math Bank</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        window.MathJax = {
            tex2jax: {
                inlineMath: [["\\(", "\\)"]],
                processEscapes: true
            }
        };
    </script>
    <script type="text/javascript"
            src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
    </script>
            <?php require('math.php'); ?>
    <script type="text/javascript">
        <!--
            function add(obj) {
                $(obj).parents(".form").find(".edit").toggle();
                if($(obj).val() === "Cancel") {
                    $(obj).val("Add New Question");
                } else  {
                    $(obj).val("Cancel");
                }
            }
            
            function add2(obj) {
                $(obj).parents(".form").find(".edit").toggle();
                if($(obj).val() === "Cancel") {
                    $(obj).val("Add New Assignment");
                } else  {
                    $(obj).val("Cancel");
                }
            }
            
            function update(obj) {
                // Update buttons to edit mode, including save and cancel
                // Hide/Show save button
                $(obj).siblings(".saveButtons").toggle();
                // While adding categories, hide sort button to make room for save button
                $(obj).siblings(".sort").toggle();
                // Set button to edit or save, whichever is opposite of what it was when clicked
                if($(obj).val() === "Cancel")  {
                    $(obj).val("Delete");
                } else    {
                    $(obj).val("Cancel");
                }
        
               
                var buttons = document.getElementsByTagName("input");
                if($(obj).val() === "Cancel") {
                    for (var i = 0; i < buttons.length; i++) {
                        if (buttons[i].type === "button" || buttons[i].type == "submit") {
                            buttons[i].disabled = true;
                            $(obj).removeAttr("disabled");
                            $(obj).siblings(".saveButtons").removeAttr("disabled");
                        }
                    }
                } else  {
                    for (var i = 0; i < buttons.length; i++) {
                        if (buttons[i].type === "button" || buttons[i].type == "submit") {
                            buttons[i].disabled = false;
                        }
                    }
                }
            }
        //    -->
    </script>
</head>
<body style="background-color: #f1f1f1;">
    <div id="masthead">
        <div class="container outer">
            <div class="row inner">
<!-- Buttons and form for adding new questions to database -->
                <form action="index.php" id="problem" name="problem" class="form" method="post">
                    <div class="col-md-3" id="problem" onclick="location.href='index.php';" style="cursor: pointer;">
                        <h1>Math Question & Assignment Bank</h1>
                    </div>
                    <br/>
                    <div class="col-md-2">
                        <input type="button" id="problemAdd" name="problemAdd" class="default btn-block" value="Add New Question" onclick="add(this)" />
                        <br/>
                        <input type="submit" id="submit" class="edit btn-block" value="Submit Question" style="display:none;" />
                    </div>
                    <div class="col-md-6">
                        <textarea rows="5" id="problem" name="problem" class="edit form-control" style="display: none;"></textarea>
                    </div>
                    <div class="col-md-1"></div>
                </form>
            </div>
        </div>
    </div>
<!-- Display assignments-->
        <div class="row">
            <nav class="col-md-3">
                <ul class="nav nav-stacked nav-pills" data-spy="affix" data-offset-top="205">
                    <p> Assignments </p>
                        <?php
                            $rowC = count($assIdArr);
                        for ($i = 0; $i < count($assIdArr); $i++){
                            ?>
                            <div class="row">
                                <form action="index.php" class="form" method="post">
                                    <li>
                                        <div class="col-md-7">
                                            <input type="text" name="ass" id="ass" class="editBox form-control" value="<?php print htmlentities($assNameArr[$i]); ?>" style="display: none;" />
                                            <div id="assignments" class="finishedPrint"> <?php print $assNameArr[$i]; ?> </div>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="hidden" id="idAssignment" name="idAssignment" value="<?php print $rowC ?>"/>
                                            <input type="submit" id="sort" name="sort" class="sort btn-sml" value="View Questions">
                                            <input type="submit" id="save" name="save" class="saveButtons btn-sml" value="Save" style="display: none;"/>
                                    </li>
                                </form>
                            </div>
                        <?php $rowC--; } ?>
    <!-- Buttons and form for adding new Assignments to database -->
                    <form action="index.php" id="assignment" name="assignment" class="form" method="post">
                        <input type="text" id="assignmentVal" name="assignmentVal" class="edit form-control" style="display:none;"/>
                        <input type="button" id="assignmentAdd" name="assignmentAdd" class="default btn-block" value="Add New Assignment" onclick="add2(this)"/>
                        <input type="submit" id="submitAss" class="edit btn-block" value="Submit Assignment" style="display:none;"/>
                    </form>
                    <br/>
                </ul>
            </nav>
    <!-- Database display, including removing existing and sorting into assignments -->
            <div class="col-md-9"  id="mainCol">
    <!-- Display table of questions stored in database, along with buttons to edit them -->
                        <?php
                        for ($i = 0; $i < count($probIdArr); $i++) {
                            $rowP = (int)$probIdArr[$i];
                            ?>
                <div class="row dataLine">
                    <div class="col-md-1">
                        <?php print $probIdArr[$i]; ?>
                    </div>
                    <form action="index.php" class="form" method="post">
                        <div class="col-md-6">
                            <input type="text" name="prob" id="prob" class="editBox form-control" value='<?php print htmlentities($probContArr[$i]); ?>' style="display: none;" />
                            <div id="problems" class="finishedPrint"> <?php print $probContArr[$i]; ?> </div>
                        </div>
                        <div class="col-md-1">
                            <input type="button" id="edit" name="edit" class="editButtons btn-block" value="Delete" onclick='update(this)'/>
                            <input type="submit" id="save" name="save" class="saveButtons btn-block" value="Delete" style="display: none;"/>
                            <input type="hidden" id="idProblem" name="idProblem" value='<?php print $rowP ?>'/>
                        </div>
                    </form>
                    <div class="col-md-2 dropdown">
                        <form action="index.php" name="dropForm" class="form" method="post">
                            <input type="submit" class="btn-block" value="Map Question"/>
                            <input type="hidden" id="dropProbId" name="dropProbId" value="<?php print $rowP ?>"/>
                            <select id="dropAssId" name="dropAssId" class="dropdown-toggle" data-toggle="dropdown">Assignments
                                <span class="caret"></span>
                                <option id="assSelect" class="assSelect" value="">Assignments</option>
                                <?php
                                    $rowD = count($assIdArr);
                                for ($j = 0; $j < count($assIdArr); $j++) {
                                    ?>
                                    <option id="assSelect" class="assSelect" value="<?php print $rowD; ?>"> <?php print htmlentities($assNameArr[$j]); ?> </option>
                                    <?php
                                    $rowD--;
                                }
                                ?>
                            </select>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <?php
                        $query = "SELECT name FROM assignment, mapping WHERE problem_id='$rowP' AND aid=assignment_id";
                        $res = mysqli_query($con, $query);
                        if($res != null) {
                            while ($rows = mysqli_fetch_assoc($res)) {
                                print "Assigned: '" . $rows['name'] . "'";
                                ?> <br/> <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                        <?php
                            $rowP--;
                        }
                        mysqli_close($con);
                        ?>
            </div>
        </div>
    </div>
</body>
</html>
