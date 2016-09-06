using System;
using System.Runtime.Serialization;

namespace GeoRent.Domain.Entities
{
    [DataContract]
    public class ResidenceImage
    {
        public ResidenceImage()
        {
            idResidenceImage = Guid.NewGuid();
        }

        [DataMember]
        public Guid idResidenceImage { get; set; }
        [DataMember]
        public string path { get; set; }
        [DataMember]
        public int resource { get; set; }
        [DataMember]
        public int order { get; set; }
        [DataMember]
        public virtual Residence idResidence { get; set; }
    }
}