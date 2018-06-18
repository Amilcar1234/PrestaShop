<?php
namespace GetResponse\WebForm;

use GrShareCode\WebForm\WebFormCollection;
use GrShareCode\WebForm\WebFormService as GrWebFormService;

/**
 * Class WebFormService
 */
class WebFormService
{
    /** @var WebFormRepository */
    private $repository;

    /** @var GrWebFormService */
    private $grWebFormService;

    /**
     * @param WebFormRepository $repository
     * @param GrWebFormService $grWebFormService
     */
    public function __construct(WebFormRepository $repository, GrWebFormService $grWebFormService)
    {
        $this->repository = $repository;
        $this->grWebFormService = $grWebFormService;
    }

    /**
     * @param WebFormDto $webForm
     */
    public function updateWebForm(WebFormDto $webForm)
    {
        $webFormUrl = $webForm->isEnabled()
            ? $this->getGetResponseFormCollection()->findOneById($webForm->getFormId())->getScriptUrl()
            : '';

        $webForm = new WebForm(
            $webForm->getFormId(),
            empty($webForm->getSubscriptionStatus()) ? WebForm::STATUS_INACTIVE : WebForm::STATUS_ACTIVE,
            empty($webForm->getPosition()) ? WebForm::SIDEBAR_DEFAULT : $webForm->getPosition(),
            empty($webForm->getStyle()) ? WebForm::STYLE_DEFAULT : $webForm->getStyle(),
            $webFormUrl
        );
        $this->repository->update($webForm);
    }

    /**
     * @return null|WebForm
     */
    public function getWebForm()
    {
        return $this->repository->getWebForm();
    }

    /**
     * @param string $subscription
     */
    public function updateWebFormSubscription($subscription)
    {
        $this->repository->updateWebFormSubscription($subscription);
    }

    /**
     * @return WebFormCollection
     */
    public function getGetResponseFormCollection()
    {
        return $this->grWebFormService->getAllWebForms();
    }
}