using System;
using System.Runtime.Serialization;

namespace GeoRent.Domain.Entities
{
    [DataContract]
    public class UserImage
    {
        public UserImage()
        {
            idUserImage = Guid.NewGuid();
        }

        [DataMember]
        public Guid idUserImage { get; set; }
        [DataMember]
        public String path { get; set; }
        [DataMember]
        public int resource { get; set; }
        [DataMember]
        public int order { get; set; }
        [DataMember]
        public virtual User idUser { get; set; }
    }
}