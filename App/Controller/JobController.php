<?php

namespace App\Controller;

use App\Controller;
use App\Model\Job;
use Library\Session;
use Library\Pagination;
use Library\Scanner;

class JobController extends Controller
{
    public function index()
    {
        $this->data["title"] = "Vagas";
        $this->data["content"] = "Job/Home";
        $this->scripts[] = "home";

        $this->data["user"] = Session::getLoggedUser();

        $job = new Job();

        if (isset($_GET["page"]) && is_numeric($_GET["page"])) {
            $current_page = $_GET["page"];
        } else {
            $current_page = 1;
        }

        $filters = [];

        if (!empty($_GET["filter_title"])) {
            $this->data["filter_title"] = $_GET["filter_title"];
            $filters["title"] = $_GET["filter_title"];
        } else {
            $this->data["filter_title"] = "";
        }

        if (isset($_GET["filter_status"]) && is_numeric($_GET["filter_status"])) {
            $this->data["filter_status"] = $_GET["filter_status"];
            $filters["status"] = $_GET["filter_status"];
        } else {
            $this->data["filter_status"] = "";
        }

        $filters["offset"] = ($_ENV["PAGINATION_LIMIT"] * ($current_page - 1));

        $this->data["jobs"] = $job->getJobs($filters);

        $this->data["status_list"] = [
            0 => "Inativa",
            1 => "Ativa"
        ];

        if (isset($_SERVER["REQUEST_URI"]) && !empty($_SERVER["QUERY_STRING"])) {
            $base_url = strtok($_SERVER["REQUEST_URI"], "?") . "?" . $_SERVER["QUERY_STRING"];
        } else {
            $base_url = "/";
        }

        $pagination = new Pagination($current_page, $job->getTotalJobs(), $base_url);

        $this->data["pagination"] = $pagination->generate();

        $this->render($this->data);
    }

    public function new()
    {
        Session::requireLogin();

        $this->data["title"] = "Cadastrar Vaga";
        $this->data["content"] = "Job/Manager";
        $this->data["header_title"] = "Cadastrar Vaga";

        if (!empty($_POST)) {
            if (empty($_POST["title"])) {
                $this->errors[] = "Atenção: Preencha o campo Título.";
            }

            if (empty($_POST["description"])) {
                $this->errors[] = "Atenção: Preencha o campo Descrição.";
            }

            if (!isset($_POST["status"])) {
                $this->errors[] = "Atenção: Preencha o campo Status.";
            }

            $job = new Job();

            $_POST["user_id"] = Session::getLoggedUser()["id"];

            if (empty($this->errors) && $job->register($_POST)) {
                $this->data["message"] = "Vaga cadastrada com sucesso.";
                $this->data["message_type"] = "success";
                unset($_POST);
            } else {
                $this->errors[] = "Não foi possível cadastrar a vaga no momento.";
            }
        }

        $form_inputs = [
            "title",
            "description",
            "status"
        ];

        foreach ($form_inputs as $input) {
            $this->data["input_" . $input] = isset($_POST[$input]) ? $_POST[$input] : "";
        }

        if (!empty($this->errors)) {
            $this->data["message"] = $this->errors;
        }

        $this->render($this->data);
    }

    public function edit()
    {
        Session::requireLogin();

        $this->data["title"] = "Editar Vaga";
        $this->data["content"] = "Job/Manager";
        $this->data["header_title"] = "Editar Vaga";

        if (empty($_GET["id"])) {
            header("Location: /");
        }

        $job = new Job();

        $this->data["job"] = $job->getJob($_GET["id"]);

        if ($this->data["job"]["user_id"] != Session::getLoggedUser()["id"]) {
            header("Location: /");
        }

        if (!empty($_POST)) {
            if (empty($_POST["title"])) {
                $this->errors[] = "Atenção: Preencha o campo Título.";
            }

            if (empty($_POST["description"])) {
                $this->errors[] = "Atenção: Preencha o campo Descrição.";
            }

            if (!isset($_POST["status"])) {
                $this->errors[] = "Atenção: Preencha o campo Status.";
            }

            $_POST["id"] = $this->data["job"]["id"];

            if (empty($this->errors) && $job->update($_POST)) {
                $this->data["message"] = "Vaga atualizada com sucesso.";
                $this->data["message_type"] = "success";
            } else {
                $this->errors[] = "Não foi possível atualizar a vaga no momento.";
            }
        }

        $form_inputs = [
            "title",
            "description",
            "status"
        ];

        foreach ($form_inputs as $input) {
            $this->data["input_" . $input] = isset($_POST[$input]) ? $_POST[$input] : $this->data["job"][$input];
        }

        $this->data["status_list"] = [
            0 => "Inativa",
            1 => "Ativa"
        ];

        if (!empty($this->errors)) {
            $this->data["message"] = $this->errors;
        }

        $this->render($this->data);
    }

    public function delete()
    {
        Session::requireLogin();

        $json = [];

        if (empty($_POST["id"])) {
            $json["error"] = true;
        }

        $job = new Job();

        if (empty($json)) {
            $this->data["job"] = $job->getJob($_POST["id"]);

            if ($this->data["job"]["user_id"] != Session::getLoggedUser()["id"]) {
                $json["error"] = true;
            }
        }

        if (empty($json) && $job->remove($_POST["id"])) {
            $json["success"] = true;
        } else {
            $json["error"] = true;
        }

        header("Content-Type: application/json");
        echo json_encode($json);
    }

    public function view()
    {
        $this->data["title"] = "Vaga";
        $this->data["content"] = "Job/Visualize";
        $this->data["header_title"] = "Cadastrar Vaga";

        if (empty($_GET["id"])) {
            header("Location: /");
        }

        $job = new Job();

        $this->data["job"] = $job->getJob($_GET["id"]);

        $this->data["status_list"] = [
            0 => "Inativa",
            1 => "Ativa"
        ];

        if (isset($_POST["print"])) {
            Scanner::render($this->data["job"]);
        }

        $this->render($this->data);
    }
}
