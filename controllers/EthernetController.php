<?php

namespace controllers;

use yasmf\HttpHelper;
use yasmf\View;

/**
 * yasmf - Yet Another Simple MVC Framework (For PHP)
 *     Copyright (C) 2019   Franck SILVESTRE
 *
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU Affero General Public License as published
 *     by the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU Affero General Public License for more details.
 *
 *     You should have received a copy of the GNU Affero General Public License
 *     along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

class EthernetController
{
    public function ethernet($pdo) {
        $view = new View("QuizReseauxPtut/views/ethernet/ethernet");
        return $view;
    }

    public function quizEthernet($pdo) {
        $view = new View("QuizReseauxPtut/views/ethernet/quizEthernet");
        return $view;
    }

    public function correction($pdo) {
        $view = new View("QuizReseauxPtut/views/ethernet/correctionEthernet");
        return $view;
    }

    public function correctionChronogramme($pdo) {
        $view = new View("QuizReseauxPtut/views/ethernet/correctionEthernetChronogramme");
        return $view;
    }

    public function ajoutScenario($pdo) {
        $view = new View("QuizReseauxPtut/views/ethernet/ajoutScenario");
        return $view;
    }

}