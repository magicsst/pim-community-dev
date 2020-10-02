import React from 'react';
import styled from 'styled-components';
import {useCatalogContext, useProductEvaluatedAttributeGroups} from "../../../../../infrastructure/hooks";
import {AttributeGroup} from "@akeneo-pim-community/settings-ui/src/models";

const translate = require('oro/translator');

const Helper = styled.div`
    margin: 5px 0 10px 0;
    background-color: #f5f9fc;
    padding: 13px 13px 13px 0;
    display: flex;
`;

const HelperIcon = styled.div`
    padding: 0 22px 0 22px;
    margin-right: 22px;
    border-right: 1px #c7cbd4 solid;
    background-image: url(/bundles/pimui/images/icon-info.svg);
    background-repeat: no-repeat;
    background-size: 20px 20px;
    background-position: center;
    width: 64px;
`;

const AttributeGroupsHelper = () => {
  const evaluatedAttributeGroups = useProductEvaluatedAttributeGroups();
  const {locale} = useCatalogContext();

  if (evaluatedAttributeGroups === null || Object.keys(evaluatedAttributeGroups).length === 0 || locale === undefined) {
    return (<></>);
  }

  return (
    <Helper>
      <HelperIcon/>
      <div>
        {translate('akeneo_data_quality_insights.attribute_group.used_groups_helper')}&nbsp;
        {Object.entries(evaluatedAttributeGroups)
          .map(([_, group]:[string, AttributeGroup]) => group.labels[locale])
          .join(', ')
        }.
      </div>
    </Helper>
  );
};

export {AttributeGroupsHelper};
