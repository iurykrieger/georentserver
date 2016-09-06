using System;
using System.Runtime.Serialization;

namespace GeoRentWebService.Entities
{
    [DataContract]
    public class ResidenceImageEntity
    {
        public ResidenceImageEntity()
        {
            this.idResidenceImage = idResidenceImage;
        }

        [DataMember]
        public int idResidenceImage { get; set; }
        [DataMember]
        public string path { get; set; }
        [DataMember]
        public int resource { get; set; }
        [DataMember]
        public int order { get; set; }
        [DataMember]
        public virtual ResidenceEntity idResidence { get; set; }
    }
}