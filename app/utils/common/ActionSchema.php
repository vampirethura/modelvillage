<?php
namespace Common;
use App\Feature;

class ActionSchema
{

	// Action scchema for rendering the button
	public static  function getActionSchema($module)
	{
			$permissions = [];
			$action_schemas = [];

			$permissions = Feature::getPermissionsByModule($module, 'table');
			foreach ($permissions as $permission)
			{
					$action_schemas ['table'][] = self::action($permission);
			}

			$panel_permissions = Feature::getPermissionsByModule($module, 'panel-default');
			foreach ($panel_permissions as $panel_permission)
			{
					$action_schemas ['panel-default'][] = self::action($panel_permission);
			}

			$panel2_permissions = Feature::getPermissionsByModule($module, 'panel-with-modal-delete');
      foreach ($panel2_permissions as $panel2_permission)
      {
          $action_schemas ['panel-with-modal-delete'][] = ActionSchema::action($panel2_permission);
      }

			$panel3_permissions = Feature::getPermissionsByModule($module, 'user_table');
      foreach ($panel3_permissions as $panel3_permission)
      {
          $action_schemas ['user_table'][] = ActionSchema::action($panel3_permission);
      }

			return $action_schemas;
	}

	# Function to generate the param for the action array formatting.
	private static function action($permission)
	{

		$return = [];

		$return = array(
        	"url" => $permission->url,
            "icon" => $permission->icon,
            "icon_bg" => $permission->icon_bg,
            "label" => $permission->descr,
            "module" => $permission->module,
            "permission" => $permission->name,
            "prompt_type"=> $permission->prompt_type,
            "prompt_title"=> $permission->prompt_title,
            "prompt_content"=> $permission->prompt_content,
            "page"=>$permission->page
        );

		return $return;
	}

}
