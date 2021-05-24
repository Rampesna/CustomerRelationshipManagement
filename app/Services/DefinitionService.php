<?php

namespace App\Services;

use App\Models\Definition;
use Illuminate\Http\Request;

class DefinitionService
{
    private $definition;

    /**
     * @return Definition
     */
    public function getDefinition(): Definition
    {
        return $this->definition;
    }

    /**
     * @param Definition $definition
     */
    public function setDefinition(Definition $definition): void
    {
        $this->definition = $definition;
    }

    public function save(Request $request)
    {
        $this->definition->company_id = $request->company_id;
        $this->definition->definition_id = $request->definition_id;
        $this->definition->name = $request->name;
        $this->definition->save();

        return $this->definition;
    }
}
