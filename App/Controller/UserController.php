<?php

namespace App\Controller;

use App\Controller;
use App\Model\User;
use Library\Session;
use Library\Mail;

class UserController extends Controller
{
    public function register()
    {
        Session::requireLogout();

        $this->data['title'] = 'Cadastrar';
        $this->data['content'] = 'User/SignUp';

        if (!empty($_POST)) {
            $user = new User();

            if (empty($_POST['name'])) {
                $this->errors[] = 'Atenção: Preencha o campo Nome Completo.';
            }

            if (empty($_POST['email'])) {
                $this->errors[] = 'Atenção: Preencha o campo Email.';
            } else if ($user->getUserByEmail($_POST['email'])) {
                $this->errors[] = 'Atenção: O email informado já pertence a um usuário.';
            }

            if (empty($_POST['password'])) {
                $this->errors[] = 'Atenção: Preencha o campo Senha.';
            }

            if (empty($_POST['confirm_password'])) {
                $this->errors[] = 'Atenção: Preencha o campo Confirmar Senha.';
            }

            if (isset($_POST['password']) && isset($_POST['confirm_password']) && ($_POST['password'] != $_POST['confirm_password'])) {
                $this->errors[] = 'Atenção: A senha está diferente da confirmação.';
            }

            if (empty($this->errors) && $user->register($_POST)) {
                $user_data = $user->getUserByEmail($_POST['email']);
                Session::login($user_data);
            } else {
                $this->errors[] = 'Não foi possível completar o registro no momento.';
            }
        }

        if (!empty($this->errors)) {
            $this->data['message'] = $this->errors;
        }

        $this->render($this->data);
    }

    public function login()
    {
        Session::requireLogout();

        $this->data['title'] = 'Acessar Conta';
        $this->data['content'] = 'User/SignIn';

        if (!empty($_POST)) {
            $user = new User();

            if (empty($_POST['email'])) {
                $this->errors[] = 'Atenção: Preencha o campo Email.';
            }

            if (empty($_POST['password'])) {
                $this->errors[] = 'Atenção: Preencha o campo Senha.';
            }

            $user_data = $user->getUserByEmail($_POST['email']);

            if (password_verify($_POST['password'], $user_data['password'])) {
                Session::login($user_data);
            } else {
                $this->errors[] = 'Atenção: Dados incorretos.';
            }
        }

        if (!empty($this->errors)) {
            $this->data['message'] = $this->errors;
        }

        if (isset($_SESSION['INTERNAL_SITUATION'])) {
            $this->data['message_type'] = 'danger';
            $this->data['message'] = 'Houve um problema interno na plataforma. 
                Tente novamente mais tarde, se o erro persistir então entre em contato com o nosso suporte.
            ';

            unset($_SESSION['INTERNAL_SITUATION']);
        }

        $this->render($this->data);
    }

    public function logout()
    {
        Session::logout();
    }

    public function reset()
    {
        Session::requireLogout();

        $user = new User();

        if (isset($_GET['token'])) {
            $this->data['title'] = 'Atualizar Senha';
            $this->data['content'] = 'User/RedefinePassword';

            $user_data = $user->getUserByToken($_GET['token']);

            if (!empty($user_data)) {
                if (isset($_POST['password']) && isset($_POST['confirm_password'])) {
                    if (($_POST['password'] == $_POST['confirm_password']) && $user->updatePassword($user_data['email'], $_GET['password'])) {
                        $this->data['message_type'] = 'success';
                        $this->data['message'] = 'Senha atualizada. Realize o login na plataforma.';
                    } {
                        $this->data['message_type'] = 'danger';
                        $this->data['message'] = 'Não foi possível atualizar a senha, verifique se a senha e a confirmação estão corretas.
                            Se o erro persistir entre em contato com o suporte.
                        ';
                    }
                }
            } else {
                $this->data['message_type'] = 'danger';
                $this->data['message'] = 'O token apresentado não é válido, verifique novamente o email.
                    Se o erro persistir faça uma nova solicitação de troca de senha.
                ';
            }
        } else {
            $this->data['title'] = 'Redefinir Senha';
            $this->data['content'] = 'User/ResetPassword';

            if (isset($_POST['email'])) {
                $user_data = $user->getUserByEmail($_POST['email']);

                $subject = 'Atualização de senha';
                $body = 'Atualização de senha';

                if (!empty($user_data) && !Mail::send($user_data['email'], $subject, $body)) {
                    $this->data['message_type'] = 'danger';
                    $this->data['message'] = 'No momento não foi possível enviar o email. 
                        Tente novamente mais tarde, se o erro persistir entre em contato com o nosso suporte.
                    ';
                } else {
                    $this->data['message_type'] = 'success';
                    $this->data['message'] = 'Se o email estiver cadastrado em nosso sistema, 
                        você receberá uma mensagem com instruções para a recuperação da senha.
                    ';
                }
            }
        }

        if (!empty($this->errors)) {
            $this->data['message'] = $this->errors;
        }

        $this->render($this->data);
    }
}
