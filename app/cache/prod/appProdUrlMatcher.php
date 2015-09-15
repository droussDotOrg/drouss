<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // fos_user_security_login
                if ($pathinfo === '/login') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_security_login;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'fos_user_security_login',);
                }
                not_fos_user_security_login:

                // fos_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_security_check;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_route' => 'fos_user_security_check',);
                }
                not_fos_user_security_check:

            }

            // fos_user_security_logout
            if ($pathinfo === '/logout') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_security_logout;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_route' => 'fos_user_security_logout',);
            }
            not_fos_user_security_logout:

        }

        if (0 === strpos($pathinfo, '/profile')) {
            // fos_user_profile_show
            if (rtrim($pathinfo, '/') === '/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_profile_show');
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::showAction',  '_route' => 'fos_user_profile_show',);
            }
            not_fos_user_profile_show:

            // fos_user_profile_edit
            if ($pathinfo === '/profile/edit') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_fos_user_profile_edit;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::editAction',  '_route' => 'fos_user_profile_edit',);
            }
            not_fos_user_profile_edit:

        }

        if (0 === strpos($pathinfo, '/re')) {
            if (0 === strpos($pathinfo, '/register')) {
                // fos_user_registration_register
                if (rtrim($pathinfo, '/') === '/register') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_registration_register;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'fos_user_registration_register');
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::registerAction',  '_route' => 'fos_user_registration_register',);
                }
                not_fos_user_registration_register:

                if (0 === strpos($pathinfo, '/register/c')) {
                    // fos_user_registration_check_email
                    if ($pathinfo === '/register/check-email') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_fos_user_registration_check_email;
                        }

                        return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
                    }
                    not_fos_user_registration_check_email:

                    if (0 === strpos($pathinfo, '/register/confirm')) {
                        // fos_user_registration_confirm
                        if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_fos_user_registration_confirm;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_confirm')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmAction',));
                        }
                        not_fos_user_registration_confirm:

                        // fos_user_registration_confirmed
                        if ($pathinfo === '/register/confirmed') {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_fos_user_registration_confirmed;
                            }

                            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
                        }
                        not_fos_user_registration_confirmed:

                    }

                }

            }

            if (0 === strpos($pathinfo, '/resetting')) {
                // fos_user_resetting_request
                if ($pathinfo === '/resetting/request') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_resetting_request;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_route' => 'fos_user_resetting_request',);
                }
                not_fos_user_resetting_request:

                // fos_user_resetting_send_email
                if ($pathinfo === '/resetting/send-email') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_resetting_send_email;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
                }
                not_fos_user_resetting_send_email:

                // fos_user_resetting_check_email
                if ($pathinfo === '/resetting/check-email') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_resetting_check_email;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
                }
                not_fos_user_resetting_check_email:

                // fos_user_resetting_reset
                if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_resetting_reset;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',));
                }
                not_fos_user_resetting_reset:

            }

        }

        // fos_user_change_password
        if ($pathinfo === '/profile/change-password') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_user_change_password;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_route' => 'fos_user_change_password',);
        }
        not_fos_user_change_password:

        // drouss_user_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'drouss_user_homepage')), array (  '_controller' => 'DROUSS\\UserBundle\\Controller\\DefaultController::indexAction',));
        }

        // book_home
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'book_home');
            }

            return array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::indexAction',  '_route' => 'book_home',);
        }

        if (0 === strpos($pathinfo, '/book')) {
            // book_home_default
            if ($pathinfo === '/book') {
                return array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::indexAction',  '_route' => 'book_home_default',);
            }

            // book_view
            if (preg_match('#^/book/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'book_view')), array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::viewAction',));
            }

            if (0 === strpos($pathinfo, '/book/category')) {
                // book_list
                if (preg_match('#^/book/category/(?P<category>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'book_list')), array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::listAction',));
                }

                if (0 === strpos($pathinfo, '/book/category2')) {
                    // book_list_publication
                    if ($pathinfo === '/book/category2/publication') {
                        return array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::listpublicationAction',  '_route' => 'book_list_publication',);
                    }

                    // book_quran
                    if ($pathinfo === '/book/category2/quran') {
                        return array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::quranAction',  '_route' => 'book_quran',);
                    }

                }

            }

            // book_list_author
            if ($pathinfo === '/book/list/author') {
                return array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::listauthorAction',  '_route' => 'book_list_author',);
            }

            // book_view_author
            if (0 === strpos($pathinfo, '/book/author') && preg_match('#^/book/author/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'book_view_author')), array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::viewauthorAction',));
            }

            // book_view_pub
            if (0 === strpos($pathinfo, '/book/pub') && preg_match('#^/book/pub/(?P<name>.{0,})$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'book_view_pub')), array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::viewpubAction',));
            }

            // book_search_science
            if (0 === strpos($pathinfo, '/book/science') && preg_match('#^/book/science/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'book_search_science')), array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::searchscienceAction',));
            }

            // book_search_language
            if (0 === strpos($pathinfo, '/book/language') && preg_match('#^/book/language/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'book_search_language')), array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::searchlanguageAction',));
            }

            // book_online_book
            if (0 === strpos($pathinfo, '/book/online') && preg_match('#^/book/online/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'book_online_book')), array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::onlinebookAction',));
            }

        }

        // book_online_pub
        if (0 === strpos($pathinfo, '/pub/online') && preg_match('#^/pub/online/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'book_online_pub')), array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::onlinepubAction',));
        }

        // book_search
        if (0 === strpos($pathinfo, '/book/search') && preg_match('#^/book/search/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'book_search')), array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::searchAction',));
        }

        // book_oumma
        if ($pathinfo === '/oumma') {
            return array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::oummaAction',  '_route' => 'book_oumma',);
        }

        // book_woman
        if ($pathinfo === '/femmes') {
            return array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::womanAction',  '_route' => 'book_woman',);
        }

        // book_womanus
        if ($pathinfo === '/woman') {
            return array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::womanusAction',  '_route' => 'book_womanus',);
        }

        // book_faqf
        if ($pathinfo === '/faq-femmes') {
            return array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::faqfAction',  '_route' => 'book_faqf',);
        }

        if (0 === strpos($pathinfo, '/admin/author')) {
            // admin_author
            if (rtrim($pathinfo, '/') === '/admin/author') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_author');
                }

                return array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\AuthorController::indexAction',  '_route' => 'admin_author',);
            }

            // admin_author_show
            if (preg_match('#^/admin/author/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_author_show')), array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\AuthorController::showAction',));
            }

            // admin_author_new
            if ($pathinfo === '/admin/author/new') {
                return array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\AuthorController::newAction',  '_route' => 'admin_author_new',);
            }

            // admin_author_create
            if ($pathinfo === '/admin/author/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_author_create;
                }

                return array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\AuthorController::createAction',  '_route' => 'admin_author_create',);
            }
            not_admin_author_create:

            // admin_author_edit
            if (preg_match('#^/admin/author/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_author_edit')), array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\AuthorController::editAction',));
            }

            // admin_author_update
            if (preg_match('#^/admin/author/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                    $allow = array_merge($allow, array('POST', 'PUT'));
                    goto not_admin_author_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_author_update')), array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\AuthorController::updateAction',));
            }
            not_admin_author_update:

            // admin_author_delete
            if (preg_match('#^/admin/author/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                    $allow = array_merge($allow, array('POST', 'DELETE'));
                    goto not_admin_author_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_author_delete')), array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\AuthorController::deleteAction',));
            }
            not_admin_author_delete:

        }

        // drouss_mail
        if ($pathinfo === '/email') {
            return array (  '_controller' => 'DROUSS\\BookBundle\\Controller\\BookController::emailAction',  '_route' => 'drouss_mail',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
