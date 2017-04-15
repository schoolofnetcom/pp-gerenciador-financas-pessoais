<?php
use Psr\Http\Message\ServerRequestInterface;


$app
    ->get(
        '/statements', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $repository = $app->service('statement.repository');
            $auth = $app->service('auth');
            $data = $request->getQueryParams();

            $dateStart = $data['date_start'] ?? (new \DateTime())->modify('-1 month');
            $dateStart = $dateStart instanceof \DateTime ? $dateStart->format('Y-m-d')
            : \DateTime::createFromFormat('d/m/Y', $dateStart)->format('Y-m-d');

            $dateEnd = $data['date_end'] ?? new \DateTime();
            $dateEnd = $dateEnd instanceof \DateTime ? $dateEnd->format('Y-m-d')
            : \DateTime::createFromFormat('d/m/Y', $dateEnd)->format('Y-m-d');

            $statements = $repository->all($dateStart, $dateEnd, $auth->user()->getId());

            return $view->render(
                'statements.html.twig', [
                'statements' => $statements
                ]
            );
        }, 'statements.list'
    );
