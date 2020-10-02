import {fetchAllAttributeGroupsDqiStatus} from '../../fetcher';
import {useEffect, useState} from "react";
import {useFetchProductFamilyInformation} from "../index";
import Attribute from "../../../domain/Attribute.interface";
import {fetchAttributeGroupsByCode} from "../../fetcher/AttributeGroup/attributeGroupsFetcher";
import {AttributeGroupCollection} from "@akeneo-pim-community/settings-ui/src/models";
import useProductAxesRates from "../ProductEditForm/useProductAxesRates";
import Axis from "../../../domain/Axis.interface";

const useProductEvaluatedAttributeGroups = () => {
  const family = useFetchProductFamilyInformation();
  const {axesRates} = useProductAxesRates();
  const [allGroupsStatus, setAllGroupStatus] = useState<null | object>(null);
  const [evaluatedGroups, setEvaluatedGroups] = useState<null | AttributeGroupCollection>(null);

  useEffect(() => {
    (async () => {
      const response = await fetchAllAttributeGroupsDqiStatus();
      setAllGroupStatus(response);
    })();
  }, []);

  useEffect(() => {
    if (allGroupsStatus === null || !axesRates || Object.keys(axesRates).length === 0 || !family || !family.attributes) {
      return;
    }

    if(Object.values(axesRates).filter((axisRates: Axis) => Object.values(axisRates.rates).length === 0).length > 0) {
      return;
    }

    (async () => {
      let familyAttributeGroups = family.attributes.map((attribute: Attribute) => attribute.group);
      familyAttributeGroups = Array.from(new Set(familyAttributeGroups)); //To remove duplicates

      const productEvaluatedGroupsCodes = Object.entries(allGroupsStatus)
        .filter(([groupCode, status]) => familyAttributeGroups.includes(groupCode) && status === true)
        .map(([groupCode, _]) => groupCode);

      if (productEvaluatedGroupsCodes.length !== familyAttributeGroups.length) {
        const attributeGroups = await fetchAttributeGroupsByCode(productEvaluatedGroupsCodes);
        setEvaluatedGroups(attributeGroups);
      }
    })();
  }, [allGroupsStatus, family, axesRates]);

  return evaluatedGroups;
};

export {useProductEvaluatedAttributeGroups};
