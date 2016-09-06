using System;
using System.Collections.Generic;
using System.Runtime.Serialization;

namespace GeoRentWebService.Entities
{
    [DataContract]
    public class ResidenceEntity
    {
        public ResidenceEntity()
        {
            this.idResidence = idResidence;
        }

        [DataMember]
        public int idResidence { get; set; }
        [DataMember]
        public virtual UserEntity idUser { get; set; }
        [DataMember]
        public virtual LocationEntity idLocation { get; set; }
        [DataMember]
        public virtual PreferenceEntity idResidencePreference { get; set; }
        [DataMember]
        public virtual List<ResidenceImageEntity> ResidenceImages { get; set; }
    }
}