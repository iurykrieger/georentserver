using System;
using System.Runtime.Serialization;

namespace GeoRent.Domain.Entities
{
    [DataContract]
    public class Location
    {
        public Location()
        {
            idLocation = Guid.NewGuid();
        }

        [DataMember]
        public Guid idLocation { get; set; }
        [DataMember]
        public string latitude { get; set; }
        [DataMember]
        public int longitude { get; set; }
        [DataMember]
        public virtual City idCity { get; set; }
    }
}