using System;
using System.Collections.Generic;
using System.Runtime.Serialization;

namespace GeoRent.Domain.Entities
{
    [DataContract]
    public class Residence
    {
        public Residence()
        {
            idResidence = Guid.NewGuid();
        }

        [DataMember]
        public Guid idResidence { get; set; }
        [DataMember]
        public virtual User idUser { get; set; }
        [DataMember]
        public virtual Location idLocation { get; set; }
        [DataMember]
        public virtual Preference idResidencePreference { get; set; }
        [DataMember]
        public virtual List<ResidenceImage> ResidenceImages { get; set; }
    }
}