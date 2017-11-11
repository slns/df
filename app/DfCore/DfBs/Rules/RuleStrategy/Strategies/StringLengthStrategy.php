<?php
/**
 *  This file is part of Dfbuilder.
 *
 *     Dfbuilder is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     Dfbuilder is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with Dfbuilder.  If not, see <http://www.gnu.org/licenses/>
 */


/*
  |--------------------------------------------------------------------------
  | Trim om the string length
  |--------------------------------------------------------------------------
  */
namespace App\DfCore\DfBs\Rules\RuleStrategy\Strategies;


use App\DfCore\DfBs\Enum\RuleConditions;
use App\DfCore\DfBs\Import\Mapping\DetectFieldType;

class StringLengthStrategy implements iContract
{
    /**
     * Each rule has is own manner of handling.
     * Per strategy we handle the rules depending on the form input what has been given in the front-end.
     * @param $es_record
     * @param $then_field
     * @param $then_field_values
     * @param $then_spacing
     * @return array
     */
    public function handle($es_record, $then_field, $then_field_values,$then_spacing)
    {
        $string_length = (isset($then_field_values[0]) ? $then_field_values[0] : '');
        if(isset($es_record['_source'][$then_field]) && DetectFieldType::isfloat($string_length)) {
            if(strlen($es_record['_source'][$then_field]) >= $string_length ) {
              $es_record['_source'][$then_field] = substr($es_record['_source'][$then_field],0,$string_length);
            }

        }
        return $es_record;

    }

    public function getRuleType()
    {
        return RuleConditions::THEN_STRING_LENGTH;
    }



}