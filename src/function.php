<?php

function redirectIfNotLogged()
{
    if (!isset($_SESSION['connexion'])) {
        redirect('pageconnexion');
    }
}

/**
 * cette fonction permet d'afficher la page d'accueil
 */
function accueil()
{
    $result = '
           <div class="content-title"><h4>Bienvenue dans le Système de Gestion de Bibliothèque en Ligne !</h4></div>
       <div class="content-details">Nous sommes ravis de vous accueillir sur notre plateforme, conçue pour rendre la gestion et l\'accès 
            aux ressources de votre bibliothèque plus simples et efficaces.</div>
      <div class="content-infos">
            <div class="info-item">
                 <div class="info-title"><h4>Fonctionnalités clés :</h4></div>
                 <div class="info-details">
                     <ul class="unlisted">
                         <li>Consultez le catalogue complet des livres disponibles.</li>
                         <li>Gérez vos emprunts et vos réservations en quelques clics.</li>
                         <li>Recevez des rappels pour le retour de vos livres.</li>
                     </ul>
                 </div>
           </div>
           <div class="info-item">
                   <div class="info-title"><h4> Connexion sécurisée :</h4></div>
                   <div class="info-details">
                   Votre compte personnel vous permet de gérer vos activités en toute sécurité.
                   </div>
           </div>
           <div class="info-item">
                   <div class="info-title"><h4>Support :</h4></div>
                   <div class="info-details">
                      Notre équipe est à votre disposition pour répondre à toutes vos questions et vous aider à tirer le meilleur parti de cette plateforme.
                   </div>
           </div>
       </div>
       <div class="content-footer">
          Bonne exploration et bonne lecture !
          <span><h2>Bibliotheque centrale de Dakar</h2></span>
       </div>
        ';

    return $result;
}
/**
 * cette fonction permet d'afficher les differents livres du bibliotheque
 * dans la page livre
 */
function livre($books = NULL)
{
    global $model;
    global $arr;
    if (is_null($books)) {
        $books = $model->getBooks();
    }
    $result = ' <div class="description-title flex gap-15 aic">
             <h3>Les differents livres du bibliotheque</h3>
      </div>
      <div class="description flex jcc">
       <table class="table">
           <thead>
             <tr>
               <th>#</th>
               <th>Titre</th>
               <th>Nom de l\'auteur</th>
               <th>Genre</th>
               <th>Date de publication</th>
               <th>ISBN</th>
               <th>Action</th>
             </tr>
           </thead>
           <tbody>';
    if ($books) {
        foreach ($books as $book) {
            $result .= '<tr>
                <th>' . $book["id"] . '</th>
                <td>' . $book["title"] . '</td>
                <td>' . $book["name_author"] . '</td>
                <td>' . $book["genre"] . '</td>
                <td>' . $book["publication_year"] . '</td>
                <td>' . $book["ISBN"] . '</td>
                <td><a href=' . ROOT . SP . 'emprunter' . SP . $book["id"] . ' class="btn">Emprunter</a></td>
              </tr>';
        }
    }
    $result .= ' </tbody>
              </table>
           </div>';

    return $result;
}
/**
 * cette fonction permet d'afficher la page ajouter un livre
 */
function ajouter()
{
    global $model;
    return '<div class="content-description flex jcc">
         <form action="handleBooks" method="POST">
             <div class="form-row flex column">
                 <label class="form-label">Titre</label>
                 <input type="text" name="title" required>
             </div>
             <div class="form-row flex column">
                 <label class="form-label">Nom de l\'auteur</label>
                 <input type="text" name="name_author" required>
             </div>
             <div class="form-row flex column">
                 <label class="form-label">Date de publication</label>
                 <input type="number" name="publication_year" required>
             </div>
             <div class="form-row flex column">
                 <label class="form-label">ISBN</label>
                 <input type="text" name="ISBN" required>
             </div>
             <div class="form-row flex column">
                 <label class="form-label">Stock</label>
                 <input type="number" name="stock" required>
             </div>
             <div class="form-row">
                 <select name="genre" id="genre" required>
                     <option value="">choisir un genre</option>
                     <option value="roman">roman</option>
                     <option value="fiction">fiction</option>
                     <option value="policier">policier</option>
                     <option value="aventure">aventure</option>
                     <option value="contemporain">contemporain</option>
                     <option value="fantastique">fantastique</option>
                     <option value="dessin animé">dessin animé</option>
                     <option value="ouvrage documentaire">Ouvrage documentaire</option>
                     <option value="science">science</option>
                     <option value="informatique">informatique</option>
                  </select>
             </div>
             <div class="form-row flex column">
                 <label class="form-label">Description</label>
                 <textarea name="description" id="description" cols="30" rows="10"></textarea>
             </div>
             <div class="form-row">
                 <button  class="addBooks btn">Ajouter le Livre</button>
             </div>
         </form>
        </div>';
}
/**
 * cette fonction permet d'ajouter un livre dans la base de données
 */
function handleBooks()
{
    global $model;
    $result = "";
    if (!empty($_POST)) {
        $title = $_POST["title"];
        $name_author = $_POST["name_author"];
        $publication_year = $_POST["publication_year"];
        $ISBN = $_POST["ISBN"];
        $stock = $_POST["stock"];
        $genre = $_POST["genre"];
        $description = $_POST["description"];
        $var = $model->addBook($title, $name_author, $genre, $publication_year, $ISBN, $stock, $description);
        if ($var) {
            //success
            $result = "<h3 class='flex jcc' style='background-color: green; color:white'>Le livre a été ajouter avec succès</h3>";
        } else {
            $result = "<h3 class='flex jcc' style='background-color: red; color:white'>le livre n'a pas été ajouter</h3>";
        }
    }
    return $result . ajouter();
}
/**
 * cette fonction permet d'afficher les livres emprunter 
 * et de ridiriger l'utilisateur vers la page livre pour pouvoir
 * emprunter un livre
 */
function emprunter()
{
    global $model;
    global $arr;
    $result = ' <div class="message">
        vous avez le droit d\'emprunter un maximum de 4 livres.
      </div>
      <div class="description">
       <table class="table">
           <thead>
             <tr>
               <th>#</th>
               <th>Titre</th>
               <th>Nom de l\'auteur</th>
               <th>Genre</th>
               <th>Date de prêt</th>
               <th>Date d\'expiration</th>
               <th>Status</th>
             </tr>
           </thead>
           <tbody>';
    $id_user = $_SESSION["connexion"]["id"];
    if (isset($arr[1])) {
        // permet à l'utilisateur d'emprunter un livre
        $id_book = $arr[1];
        $book = $model->getBooks($id_book);
        $book = $book[0];
        if ($book["stock"] > 0) {
            $stock = $book["stock"] - 1;
            $quantity_loan = $book["quantity_loan"] + 1;
            $var = $model->upDateBook($id_book, $stock, $quantity_loan);
            $date_future = new DateTime();
            $loan_date = $date_future->format("Y-m-d");
            $expire_date = $date_future->modify("+7 days");
            $due_date = $expire_date->format("Y-m-d");
            $loan_status = "En cours";
            $var = $model->addLoan($id_book, $id_user, $loan_date, $due_date, $loan_status);
        }
    }
    $loan_books = $model->getLoan(null, $id_user);
    if ($loan_books) {
        foreach ($loan_books as $loan_book) {
            $book = $model->getBooks($loan_book["id_book"]);
            $book = $book[0];
            // print_r($book); exit() ;
            $result .= '<tr>
                <th>' . $book["id"] . '</th>
                <td>' . $book["title"] . '</td>
                <td>' . $book["name_author"] . '</td>
                <td>' . $book["genre"] . '</td>
                <td>' . $loan_book["loan_date"] . '</td>
                <td>' . $loan_book["due_date"] . '</td>
                <td>' . $loan_book["loan_status"] . '</td>
              </tr>';
        }
    } else {
        //Aucun livre n'a été emprunter
    }
    $result .= '</tbody>
        </table>
        </div>';
    $href = ROOT . SP . "Livre";
    $loan = '<h4>Emprunter un livre en cliquant <a href="' . $href . '" style="text-decoration:underline; color:green">ici</a></h4>';
    $result .= $loan;
    return $result;
}
/**
 * cette fonction permet à l'utilisateur de retourner un livre 
 * en donnant l'identifiant du livre
 */
function dueloan()
{
    global $model;
    if (isset($_POST["identifiant"])) {
        $id_book = $_POST["identifiant"];
        $book = $model->getBooks($id_book);
        $book = $book[0];
        if ($book && $book["quantity_loan"] > 0) {
            $stock = $book["stock"] + 1;
            $quantity_loan = $book["quantity_loan"] - 1;
            $model->upDateBook($id_book, $stock, $quantity_loan);
            $id_user = $_SESSION["connexion"]["id"];
            $loan_books = $model->getLoan(null, $id_user);
            foreach ($loan_books as $loan_book) {
                if ($loan_book["id_book"] == $id_book) {
                    $id = $loan_book["id"];
                    // print_r($id) ; exit() ;
                    $model->deleteLoan($id);
                    $result = "<h3 class='flex jcc' style='background-color: green; color:white'>Le livre a été retirer de la liste des prêts</h3>";
                }
            }
            if (!isset($result)) {
                $result = "<h3 class='flex jcc' style='background-color: green; color:white'>Le livre n'a pas été retirer de la liste des prêts</h3>";
            }
        } else {
            $result = "<h3 class='flex jcc' style='background-color: green; color:white'>Verifier l'identifiant saisie </h3>";
        }
        return $result . retourner();
    }
}
/**
 * cette fonction permet d'afficher la page de retourner un livre
 */
function retourner()
{
    $result = ' <form action="dueLoan" method="post">
        <div class="form-row flex column">
            <label class="form-label">L\'identifiant du livre</label>
            <input type="number" name="identifiant" required>
        </div>
        <button type="submit" class="form-btn btn ">
            Retourner le Livre
        </button>
       </form>';
    return $result;
}
/**
 * cette fonction permet d'afficher la page recherche
 */
function rechercher($inputValue = NULL)
{
    // var_dump($inputValue) ; exit() ;
    $input = '<input type="search" name="input_search"';
    if (!is_null($inputValue)) {
        $inputValue = htmlspecialchars($inputValue);
        $input .= ' value="' . $inputValue . '"';
    }
    $input .= ' required>';
    $result = '<form action="displaySearchBooks" method="post" style="margin-bottom:10px ;">
         Rechercher par 
         <select name="search" id="search" required>
           <option value="">titre,auteur ou genre</option>
           <option value="titre">titre</option>
           <option value="auteur">auteur</option>
           <option value="genre">genre</option>
        </select>
        <div class="search-bar">
            ' . $input . '
        </div>
        <button type="submit" class="search-btn btn">Demarer la recherche</button>
        </form>
        ';
    return $result;
}
/**
 * cette fonction permet de rechercher des livres apartir des information 
 * fournies par l'utilisateur
 */
function displaysearchbooks()
{
    // print_r($_POST); exit();
    global $model;
    $search = $_POST["search"];
    $input_search = $_POST["input_search"];
    if (isset($search) && isset($input_search)) {
        if ($search == "titre") {
            $books = $model->getBooks(NULL, NULL, $input_search);
        }
        if ($search == "auteur") {
            $books = $model->getBooks(NULL, $input_search);
        }
        if ($search == "genre") {
            $books = $model->getBooks(NULL, NULL, NULL, $input_search);
        }
    }
    if ($books) {
        return rechercher() . livre($books);
    }
    return rechercher($input_search);
}


/**
 * Les fonctions de gestion de la connexion ou de 
 * l'inscription de l'utlisateur à notre site
 */

function trimData($tab)
{
    if (is_array($tab)) {
        # code...
        foreach ($tab as $key => $value) {
            # code...
            $tab[$key] = htmlspecialchars(trim($value));
        }
        return $tab;
    }
}
function pageregister()
{
    include "../views/reception/register.php";
}
function pageconnexion()
{
    include "../views/reception/login.php";
}
function register()
{
    global $model;
    // print_r($_POST) ; exit() ;
    if (!empty($_POST)) {
        $_POST = trimData($_POST);
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $adresse = $_POST["adresse"];
        $user_status = $_POST["role"];
        $password = $_POST["password"];
        $var = $model->addUser($firstname, $lastname, $email, $adresse, $user_status, $password);
        if ($var) {
            //l'utilisateur a été inscrit avec succès
            pageconnexion();
        } else {
            //Error: l'utilisateur n'a pas été inscrit
            pageregister();
        }
    } else {
        pageregister();
    }
}
function authentifier()
{
    global $model;
    if (!empty($_POST)) {
        $_POST = trimData($_POST);
        $email = $_POST["email"];
        $user = $model->getUser(null, $email);
        if ($user && $user["password"] == sha1($_POST["password"])) {
            //connexion reussie
            unset($user["password"]);
            $_SESSION["connexion"] = $user;
            $title = "Acueil";
            $function = "accueil";
            $content = $function();

            include "../views/template/default.php";
        } else {
            //connexion echouée
            pageconnexion();
        }
    } else {
        pageconnexion();
    }
}
function deconnexion()
{
    if (isset($_SESSION["connexion"])) {
        unset($_SESSION["connexion"]);
        pageconnexion();
        exit();
    }
}

?>


<!-- <ul class="unlisted dropdown">
        <li><a class="dropdown-item" href="#">roman</a></li>
        <li><a class="dropdown-item" href="#">fiction</a></li>
        <li><a class="dropdown-item" href="#">policier</a></li>
        <li><a class="dropdown-item" href="#">aventure</a></li>
        <li><a class="dropdown-item" href="#">contemporain</a></li>
        <li><a class="dropdown-item" href="#">fantastique</a></li>
        <li><a class="dropdown-item" href="#">dessin animé</a></li>
        <li><a class="dropdown-item" href="#">Ouvrage documentaire</a></li>
        <li><a class="dropdown-item" href="#">science</a></li>
        <li><a class="dropdown-item" href="#">informatique</a></li>
</ul> -->